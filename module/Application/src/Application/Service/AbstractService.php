<?php
namespace Application\Service;


use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;

class AbstractService {

    private $sm;

    /**
     * @param $sm ServiceManager
     */
    function __construct($sm)
    {
        $this->sm = $sm;
    }

    /**
     * @return EntityManager
     */
    protected  function getEntityManager()
    {
        $em = $this
            ->sm
            ->get('Doctrine\ORM\EntityManager');
        /*$em->getConnection()
            ->getConfiguration()
            ->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());*/
        return $em;
    }

    protected function getConfig($key)
    {
        $config = $this->sm->get('Config');
        return $config[$key];
    }
}