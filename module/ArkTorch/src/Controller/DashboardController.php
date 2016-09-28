<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController {
    public function indexAction() {
        $viewModel = new ViewModel([

        ]);

        return $viewModel;
    }
}