<?php

namespace Application\Api\Controller;


use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractRestfulController;

class AbstractBaseApiController extends AbstractRestfulController
{

    private $authService;

    protected function getAuthService()
    {
        if ($this->authService == null) {
            $this->authService = $this->serviceLocator->get('AuthService');
        }
        return $this->authService;
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
     * @return bool|mixed
     */
    protected function getParams()
    {
        $contentType = $this->getRequest()->getHeaders()->get('Content-Type');
        $request = $this->getRequest();
        if (strpos($contentType->getFieldValue(), 'application/json') > -1) {
            return Json::decode($request->getContent());
        }
        return false;
    }


    /**
     * @param $jsonData
     * @return mixed
     */
    protected function writeJsonResponse($jsonData, $code = 200)
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");
        $response->setStatusCode($code);
        return $response->setContent(Json::encode($jsonData));
    }

    /**
     * @return User
     */
    protected function getCurrentUser(){
        return $this->getAuthService()->getIdentity();
    }
}