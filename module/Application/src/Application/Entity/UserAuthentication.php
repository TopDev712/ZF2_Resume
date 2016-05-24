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
 * @Table(name="USER_AUTHENTICATIONS")
 * @Entity
 *
 * @author konerig
 */
class UserAuthentication extends BaseEntity
{

    const AUTH_PROVIDER_EMAIL = "EMAIL";
    const AUTH_PROVIDER_FACEBOOK = "FACEBOOK";
    const AUTH_PROVIDER_GOOGLE = "GOOGLE";
    const AUTH_PROVIDER_LINKED_IN = "LINKED_ID";

    /**
     *
     * @var integer $id
     * @Column(name="USER_AUTHENTICATION_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="AUTHENTICATION_PROVIDER",type="string",length=100,nullable=false)
     *
     * @var string
     */
    private $authenticationProvider;

    /**
     * @Column(name="USER_NAME",type="string",length=100,nullable=false)
     *
     * @var string
     */
    private $userName;

    /**
     * @Column(name="PASSWORD",type="string",length=1000,nullable=true)
     *
     * @var string
     */
    private $password;
    /**
     * @Column(name="RESET_TOKEN",type="string",length=15,nullable=true)
     *
     * @var string
     */
    private $resetToken;

    /**
     * @Column(name="DATETIME_CREATED",type="datetime",nullable=false)
     *
     * @var string
     */
    private $dateTimeCreated;

    /**
     * @Column(name="DATETIME_MODIFIED",type="datetime",nullable=true)
     *
     * @var string
     */
    private $dateTimeModified;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="FK_USER_ID", referencedColumnName="USER_ID", nullable=false)
     * @var User
     */
    private $user;

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
    public function getAuthenticationProvider()
    {
    	return $this->authenticationProvider;
    }
    /**
     * @param string $authenticationProvider
     */
    public function setAuthenticationProvider($authenticationProvider)
    {
    	$this->authenticationProvider = $authenticationProvider;
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
     * @return string
     */
    public function getPassword()
    {
    	return $this->password;
    }
    
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
    	$this->password = $password;
    }
    
    /**
     * @return string
     */
    public function getResetToken()
    {
    	return $this->resetToken;
    }
    
    /**
     * @param string $resetToken
     */
    public function setResetToken($resetToken)
    {
    	$this->resetToken = $resetToken;
    }
      
    /**
     * @return string
     */
    public function getDateTimeCreated()
    {
    	return $this->dateTimeCreated;
    }
    
    /**
     * @param string $dateTimeCreated
     */
    public function setDateTimeCreated($dateTimeCreated)
    {
    	$this->dateTimeCreated = $dateTimeCreated;
    }  
   
    /**
     * @return string
     */
    public function getDateTimeModified()
    {
    	return $this->dateTimeModified;
    }
    
    /**
     * @param string $dateTimeModified
     */
    public function setDateTimeModified($dateTimeModified)
    {
    	$this->dateTimeModified = $dateTimeModified;
    }
    
    /**
     * @return User
     */
    public function getUser()
    {
    	return $this->user;
    }
    
    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
    	$this->user = $user;
    }
    
    public function getValues(){
    	return array(
    			'authId'=>$this->id,
    			'userName'=>$this->userName,
    			'authenticationProvider'=>$this->authenticationProvider,
    			'user'=>$this->user
    	);
    }

}