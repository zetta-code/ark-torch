<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Controller;

use ArkTorch\Entity\Stat;
use ArkTorch\Form\SetupForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SetupController extends AbstractActionController
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $namespace = 'arkTorch';

    /**
     * SetupController constructor.
     * @param array $config
     * @param EntityManager $entityManager
     */
    public function __construct(array $config, EntityManager $entityManager)
    {
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $form = new SetupForm($this->entityManager);
        $form->setAttribute('action', $this->url()->fromRoute('arkTorch', array('controller' => 'setup',  'action' => 'index')));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);

            if ($form->isValid()) {
                $this->setupDB();
                $this->setupStats();

                $this->entityManager->flush();
                $this->flashMessenger()->addSuccessMessage(_('Setup made with success!'));
                return $this->redirect()->toRoute('arkTorch', ['controller' => 'dashboard']);
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

    protected function setupDB() {
        $db = new \PDO('mysql:host=localhost;dbname=arktorch', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        $file = file_get_contents(getcwd() . '/data/arktorch.sql');
        $db->exec($file);
    }

    protected function setupStats() {
        $stats = $this->config[$this->namespace]['stats'];

        foreach ($stats as $stat) {
            $statEntity = new Stat();
            $statEntity->setId($stat['id']);
            $statEntity->setType($stat['type']);
            $statEntity->setShortName($stat['short_name']);
            $statEntity->setName($stat['name']);
            $this->entityManager->persist($statEntity);
        }
        $this->entityManager->flush();
    }
}