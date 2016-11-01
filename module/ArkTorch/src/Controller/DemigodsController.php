<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Controller;

use ArkTorch\Entity\InhabitantStat;
use ArkTorch\Entity\Inhabitant;
use ArkTorch\Entity\Repository\InhabitantRepository;
use ArkTorch\Entity\Repository\InhabitantStatRepository;
use ArkTorch\Entity\Stat;
use ArkTorch\Form\DemigodForm;
use Doctrine\ORM\EntityManager;
use Exception;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DemigodsController extends AbstractActionController {
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DemigodsController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $identity = $this->identity();
        /** @var InhabitantRepository $inhabitantRepo */
        $inhabitantRepo = $this->entityManager->getRepository(Inhabitant::class);
        /** @var InhabitantStatRepository $inhabitantStatRepo */
        $inhabitantStatRepo = $this->entityManager->getRepository(InhabitantStat::class);
        $demigod = $inhabitantRepo->getDemigod($identity);
        $stats = $inhabitantStatRepo->getInhabitantStats($demigod, [
            Stat::STAT_MAX_HP, Stat::STAT_HP,
            Stat::STAT_MAX_MANA, Stat::STAT_MANA,
        ]);

        $viewModel = new ViewModel([
            'demigod' => $demigod,
            'stats' => $stats
        ]);

        return $viewModel;
    }

    public function firstAction() {
        $identity = $this->identity();

        $inhabitantRepo = $this->entityManager->getRepository(Inhabitant::class);
        /** @var InhabitantStatRepository $inhabitantStatRepo */
        $inhabitantStatRepo = $this->entityManager->getRepository(InhabitantStat::class);
        $qb = $inhabitantRepo->createQueryBuilder('i');
        $qb->join('i.users', 'u');
        $qb->where('u = :user AND i.type = :type AND i.active = :active');
        $qb->setParameters([
            'user' => $identity,
            'type' => Inhabitant::TYPE_DEMIGOD,
            'active' => true
        ]);

        $demigod = $qb->getQuery()->getOneOrNullResult();
        if (!is_null($demigod)) {
            return $this->redirect()->toRoute('arkTorch', ['controller' => 'dashboard']);
        }

        $form = new DemigodForm($this->entityManager);
        $form->setAttribute('action', $this->url()->fromRoute('arkTorch', array('controller' => 'demigods',  'action' => 'first')));
        $demigod = new Inhabitant();
        $form->bind($demigod);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);

            if ($form->isValid()) {
                $this->entityManager->getConnection()->beginTransaction();
                try {
                    $demigod->setType(Inhabitant::TYPE_DEMIGOD);
                    $identity->addInhabitant($demigod);
                    $this->entityManager->persist($demigod);
                    $this->entityManager->flush();

                    $inhabitantStatRepo->put($demigod, Stat::STAT_MAX_HP, 100);
                    $inhabitantStatRepo->put($demigod, Stat::STAT_HP, 10);
                    $inhabitantStatRepo->put($demigod, Stat::STAT_MAX_MANA, 50);
                    $inhabitantStatRepo->put($demigod, Stat::STAT_MANA, 0);

                    $this->entityManager->flush();
                    $this->entityManager->getConnection()->commit(); // commit
                    $this->flashMessenger()->addSuccessMessage(_('Demigod created with success!'));
                    return $this->redirect()->toRoute('arkTorch', ['controller' => 'dashboard']);
                } catch(Exception $e) {
                    $this->entityManager->getConnection()->rollBack();
                    $this->flashMessenger()->addErrorMessage(_('Try again.'));
                }
            } else {
                $this->flashMessenger()->addErrorMessage(_('Form with errors!'));
            }
        }

        $form->prepare();
        $viewModel = new ViewModel([
            'form' => $form
        ]);
        return $viewModel;
    }
}