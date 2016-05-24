<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Service\JobSearchService;
use Application\Service\LoginAuditService;
use Application\Service\VisitService;
use Application\Service\UserRegistrationService;
use Application\Util\AuthenticationAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Service\JobAlertService;
use Zend\Permissions\Acl\Acl;
use Application\Service\EmailService;
use Application\Service\ResetPasswordService;
use Application\Service\UserJobClickService;
use Application\Service\ProfileService;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Util\UserSessionManager' => function ($sm) {
                    return new \Application\Util\UserSessionManager('resume2work');
                },
                'AuthService' => function ($sm) {
                    $authenticationAdapter = new  AuthenticationAdapter($sm, $sm->get('Doctrine\ORM\EntityManager'));

                    $authService = new AuthenticationService();
                    $authService->setAdapter($authenticationAdapter);
                    $authService->setStorage($sm->get('Application\Util\UserSessionManager'));

                    return $authService;
                },
                "loginAuditService" => function ($sm) {
                    return new LoginAuditService($sm);
                }, "visitService" => function ($sm) {
                    return new VisitService($sm);
                }, "jobSearchService" => function ($sm) {
                    return new JobSearchService($sm);
                }, "userRegistrationService" => function ($sm) {
                    return new UserRegistrationService($sm);
                }, "jobAlertService" => function ($sm) {
                    return new JobAlertService($sm);
                }, "EmailService" => function ($sm) {
                    return new EmailService($sm);
                }, "ResetPasswordService" => function ($sm) {
                    return new ResetPasswordService($sm);
                }, "userJobClickService" => function ($sm) {
                    return new UserJobClickService($sm);
                }, "ProfileService" => function ($sm) {
                	return new ProfileService($sm);
                }
            ),
            'aliases' => array(
                'Zend\Authentication\AuthenticationService' => 'AuthService'
            ),
            
            'ViewHelper' => function($sm){
            $helper = new \Application\Util\ViewHelper();
            $request = $sm->getServiceLocator()->get('Request');
            $helper->setRequest($request);
            return $helper;
            }
        );
    }

    public function initAcl(MvcEvent $e)
    {

        $roles = include __DIR__ . '/config/module.acl.roles.php';

        $acl = new Acl();
        foreach ($roles as $role => $resources) {
            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl->addRole($role);

            foreach ($resources as $resource) {
                if (!$acl->hasResource($resource)) {
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
                }
                $acl->allow($role, $resource);
            }
        }
        $e->getViewModel()->acl = $acl;
    }

    public function checkAcl(MvcEvent $e)
    {
        $params = $e->getRouteMatch()->getParams();
        $role = 'guest';

        $module = isset($params['__MODULE__']) ? "/" . $params['__MODULE__'] : "";
        $controller = isset($params['__CONTROLLER__']) ? "/" . $params['__CONTROLLER__'] : "";
        if (isset($params['action'])) {
            $uri = strtolower($module . $controller . ($params['action'] != 'index' ? ('/' . $params['action']) : ""));
        } else {
            $uri = strtolower($module . $controller);
        }
        $user = $e->getApplication()->getServiceManager()->get('AuthService')->getIdentity();


        if ($user) {
            $role = "jobseeker";
        }
        try{
	        if (!$e->getViewModel()->acl->isAllowed($role, $uri)) {
	            $response = $e->getResponse();
	            $response->getHeaders()->addHeaderLine('Location', '/');
	            $response->setStatusCode(302);
	            $response->sendHeaders();
	        }
        }catch(\Exception $error){
        	//error needs to be logged and then redirected to error page
        	//$errorMessage = print_r($error->getMessage(),true);
        }
    }
}
