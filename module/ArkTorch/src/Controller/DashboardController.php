<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Controller;

use ArkTorch\Entity\Inhabitant;
use ArkTorch\Entity\Repository\InhabitantRepository;
use ArkTorch\Entity\Role;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController {
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DashboardController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $identity = $this->identity();
        /** @var InhabitantRepository $inhabitantRepo */
        $inhabitantRepo = $this->entityManager->getRepository(Inhabitant::class);

        if ($identity->getRole()->getId() == Role::MEMBER) {
            $demigod = $inhabitantRepo->getDemigod($identity);
            if (is_null($demigod)) {
                return $this->redirect()->toRoute('arkTorch', ['controller' => 'demigods', 'action' => 'first']);
            } else {
                return $this->forward()->dispatch(DemigodsController::class);
            }
        }

        $viewModel = new ViewModel([

        ]);

        return $viewModel;
    }
}