<?php
namespace Application\Repository;

use Doctrine\ORM\NoResultException;

class UserRepository extends AbstractRepository
{

    public function findUserAuthenticationByProvider($id, $authProvider){
        try {
            return $this->getEntityManager()->createQuery("select ua
            from \Application\Entity\UserAuthentication ua
            where ua.userName = :userName and ua.authenticationProvider = :authProvider ")
                ->setParameter("userName", $id)
                ->setParameter("authProvider", $authProvider)
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }
}