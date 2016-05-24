<?php

namespace Application\Util;


use Application\Entity\Employer;
use Application\Entity\JobSeeker;
use Application\Entity\User;
use Application\Entity\UserAuthentication;
use Application\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Result;
use Zend\ServiceManager\ServiceManager;

class AuthenticationAdapter extends AbstractAdapter
{

    private $entityManager;

    private $authProvider;

    private $socialLoginParams;

    /**
     * @param $sm ServiceManager
     * @param $entityManager EntityManager
     */
    function __construct($sm, $entityManager)
    {
        $this->serviceManager = $sm;
        $this->entityManager = $entityManager;
    }


    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $userRepository = $this->getUserRepository();
        if ($this->authProvider == UserAuthentication::AUTH_PROVIDER_EMAIL) {
            return $this->emailAuthentication($userRepository);
        } else if ($this->authProvider == UserAuthentication::AUTH_PROVIDER_FACEBOOK) {

        } else if ($this->authProvider == UserAuthentication::AUTH_PROVIDER_GOOGLE) {

        } else if ($this->authProvider == UserAuthentication::AUTH_PROVIDER_LINKED_IN) {

        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
    }

    /**
     * @param mixed $authProvider
     * @return $this
     */
    public function setAuthProvider($authProvider)
    {
        $this->authProvider = $authProvider;
        return $this;
    }

    /**
     * @parm bam mixed $socialLoginParams
     * @return $this
     */
    public function setSocialLoginParams($socialLoginParams)
    {
        $this->socialLoginParams = $socialLoginParams;
        return $this;
    }

    /**
     * @return  \Application\Repository\UserRepository
     */
    private function getUserRepository()
    {
        return $this->entityManager->getRepository('Application\Entity\User');
    }

    /**
     * @param $user \Application\Entity\User
     * @return \Application\Entity\User
     */
    private function _copyUser($user)
    {
        $c = new User();
        $c->setId($user->getId());
        $c->setEmail($user->getEmail());
        $c->setFirstName($user->getFirstName());
        $c->setLastName($user->getLastName());
        $c->setDateTimeLastLogin($user->getDateTimeLastLogin());
        $c->setUserType($user->getUserType());
        if ($user->getUserType() == User::USER_TYPE_JOB_SEEKER) {
            $c->setJobSeeker(new JobSeeker());
            $c->getJobSeeker()->setId($user->getJobSeeker()->getId());
            $c->getJobSeeker()->setUser($c);
        }
        return $c;
    }

    /**
     * @param $userRepository \Application\Repository\UserRepository
     * @return Result
     */
    private function emailAuthentication($userRepository)
    {
        $userAuth = $userRepository->findUserAuthenticationByProvider($this->identity, UserAuthentication::AUTH_PROVIDER_EMAIL);
        if ($userAuth != null && $userAuth->getPassword() == $this->credential) {
            $userAuth->getUser()->setDateTimeLastLogin(new \DateTime());
            $userRepository->update($userAuth->getUser());
            $this->entityManager->flush();
            return new Result(Result::SUCCESS, $this->_copyUser($userAuth->getUser()));
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
        }
    }
}