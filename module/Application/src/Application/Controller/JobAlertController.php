<?php
namespace Application\Controller;


use Zend\View\Model\ViewModel;

class JobAlertController extends AbstractBaseController
{

    public function indexAction()
    {
        return new ViewModel();
    }
}