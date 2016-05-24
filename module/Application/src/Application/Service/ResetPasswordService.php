<?php

namespace Application\Service;

use Application\Entity\UserAuthentication;

class ResetPasswordService extends AbstractService
{


    /**
     * @param $user User
     * @param $data array
     * @return bool
     */
    public function update($user, $data)
    {
        $user->setPassword($data['password']);
        $user->setDateTimeModified(new \DateTime());
        $user->setResetToken(null);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return true;
    }
    
    public function getUserByToken($token) {
    	$user = $this->getEntityManager()->getRepository('Application\Entity\UserAuthentication')->findOneBy(
    				array('resetToken' => $token)
    				);
    	if($user){
    		return $user;
    	}else{
    		return false;
    	}
    }
    
    public function updateToken($user, $data)
    {
    	$user->setDateTimeModified(new \DateTime());
    	$user->setResetToken($data['resetToken']);
    	$this->getEntityManager()->persist($user);
    	$this->getEntityManager()->flush();
    	return true;
    }

}