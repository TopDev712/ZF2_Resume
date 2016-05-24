<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 *
 * @Table(name="USER_LOGIN_AUDIT")
 * @Entity(repositoryClass="\Application\Repository\UserLoginAuditRepository")
 *
 * @author konerig
 */
class UserLoginAudit extends BaseEntity
{

    const LOGIN_SUCESS = "Y";
    const LOGIN_FAIL = "N";

    /**
     *
     * @var integer $id
     * @Column(name="USER_LOGIN_AUDIT_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="DATETIME_LOGIN",type="datetime",nullable=false)
     *
     * @var string
     */
    private $dateTimeLogin;


    /**
     * @Column(name="LOGIN_SUCCESS_FLAG",type="string",length=1,nullable=false)
     *
     * @var string
     */
    private $loginSuccessFlag;

    /**
     * @Column(name="USER_NAME",type="string",length=255,nullable=true)
     *
     * @var string
     */
    private $userName;

    /**
     * @ManyToOne(targetEntity="UserAuthentication")
     * @JoinColumn(name="FK_USER_AUTHENTICATION_ID", referencedColumnName="USER_AUTHENTICATION_ID", nullable=true)
     * @var UserAuthentication
     */
    private $userAuthentication;

    protected function getProperties()
    {
        return get_object_vars($this);
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDateTimeLogin()
    {
        return $this->dateTimeLogin;
    }

    /**
     * @param string $dateTimeLogin
     */
    public function setDateTimeLogin($dateTimeLogin)
    {
        $this->dateTimeLogin = $dateTimeLogin;
    }

    /**
     * @return string
     */
    public function getLoginSuccessFlag()
    {
        return $this->loginSuccessFlag;
    }

    /**
     * @param string $loginSuccessFlag
     */
    public function setLoginSuccessFlag($loginSuccessFlag)
    {
        $this->loginSuccessFlag = $loginSuccessFlag;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return UserAuthentication
     */
    public function getUserAuthentication()
    {
        return $this->userAuthentication;
    }

    /**
     * @param UserAuthentication $userAuthentication
     */
    public function setUserAuthentication($userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }


}