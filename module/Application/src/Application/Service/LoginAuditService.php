<?php

namespace Application\Service;


use Application\Entity\UserLoginAudit;

class LoginAuditService extends AbstractService
{


    public function logSuccess($dateTimeLogin, $userAuthentication)
    {
        $audit = new UserLoginAudit();
        $audit->setDateTimeLogin($dateTimeLogin);
        $audit->setLoginSuccessFlag(UserLoginAudit::LOGIN_SUCESS);
        $audit->setUserAuthentication($userAuthentication);

        $auditRepo = $this->getEntityManager()->getRepository("\Application\Entity\UserLoginAudit");
        $auditRepo->save($audit);
        $auditRepo->flush();
    }

    public function logFailed($dateTimeLogin, $userName)
    {
        $audit = new UserLoginAudit();
        $audit->setDateTimeLogin($dateTimeLogin);
        $audit->setLoginSuccessFlag(UserLoginAudit::LOGIN_FAIL);
        $audit->setUserName($userName);

        $auditRepo = $this->getEntityManager()->getRepository("\Application\Entity\UserLoginAudit");
        $auditRepo->save($audit);
    }
}