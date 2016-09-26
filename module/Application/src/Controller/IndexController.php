<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
