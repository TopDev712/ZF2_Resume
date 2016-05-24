<?php

namespace Application\Controller;


use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;

class AbstractBaseController extends AbstractActionController
{

    protected $authService;

    protected function getAuthService()
    {
        if ($this->authService == null) {
            $this->authService = $this->serviceLocator->get('AuthService');
        }
        return $this->authService;
    }

    /**
     * @param $jsonData
     * @return mixed
     */
    protected function writeJsonResponse($jsonData)
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");
        return $response->setContent(Json::encode($jsonData));
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        $em = $this
            ->serviceLocator
            ->get('Doctrine\ORM\EntityManager');

        /*$em->getConnection()
            ->getConfiguration()
            ->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());*/
        return $em;
    }

    /**
     * @return User
     */
    protected function getCurrentUser(){
        return $this->getAuthService()->getIdentity();
    }
}