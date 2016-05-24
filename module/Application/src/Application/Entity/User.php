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
use Doctrine\ORM\Mapping\OneToOne;

/**
 *
 * @Table(name="USERS")
 * @Entity(repositoryClass="\Application\Repository\UserRepository")
 *
 * @author konerig
 */
class User extends BaseEntity
{

    const LOCKED_YES = "Y";
    const LOCKED_NO = "N";
    const DELETED_YES = "Y";
    const DELETED_NO = "N";

    const USER_TYPE_JOB_SEEKER = "JOB_SEEKER";
    const USER_TYPE_EMPLOYER = "EMPLOYER";
    const USER_TYPE_EMPLOYEE = "EMPLOYEE";

    /**
     *
     * @var integer $id
     * @Column(name="USER_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="USER_TYPE",type="string",length=10,nullable=false)
     *
     * @var string
     */
    private $userType;

    /**
     * @Column(name="FIRST_NAME",type="string",length=255,nullable=false)
     *
     * @var string
     */
    private $firstName;

    /**
     * @Column(name="LAST_NAME",type="string",length=100,nullable=false)
     *
     * @var string
     */
    private $lastName;

    /**
     * @Column(name="EMAIL",type="string",length=100,nullable=false)
     *
     * @var string
     */
    private $email;

    /**
     * @Column(name="STREET",type="string",length=100,nullable=true)
     *
     * @var string
     */
    private $street;

    /**
     * @Column(name="CITY",type="string",length=100,nullable=true)
     *
     * @var string
     */
    private $city;

    /**
     * @Column(name="STATE",type="string",length=100,nullable=true)
     *
     * @var string
     */
    private $state;

    /**
     * @Column(name="ZIP_CODE",type="string",length=10,nullable=true)
     *
     * @var string
     */
    private $zipCode;

    /**
     * @Column(name="DATETIME_LAST_LOGIN",type="datetime",nullable=true)
     *
     * @var string
     */
    private $dateTimeLastLogin;

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
     * @Column(name="LOCKED_FLAG", type="string",length=1,nullable=false)
     *
     * @var string
     */
    private $lockedFlag = User::LOCKED_NO;

    /**
     * @Column(name="DELETED_FLAG",type="string",length=1,nullable=false)
     *
     * @var string
     */
    private $deletedFlag = User::DELETED_NO;

    /**
     * @ManyToOne(targetEntity="Employer")
     * @JoinColumn(name="FK_CURRENT_EMPLOYER_ID", referencedColumnName="EMPLOYER_ID", nullable=true)
     * @var Employer
     */
    private $currentEmployer;

    /**
     * @OneToMany(targetEntity="UserAuthentication", mappedBy="user")
     *
     */
    private $userAuthentications;

    /**
     * @OneToOne(targetEntity="JobSeeker", mappedBy="user")
     *
     */
    private $jobSeeker;

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
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->city = $state;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getDateTimeLastLogin()
    {
        return $this->dateTimeLastLogin;
    }

    /**
     * @param string $dateTimeLastLogin
     */
    public function setDateTimeLastLogin($dateTimeLastLogin)
    {
        $this->dateTimeLastLogin = $dateTimeLastLogin;
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
     * @return string
     */
    public function getLockedFlag()
    {
        return $this->lockedFlag;
    }

    /**
     * @param string $lockedFlag
     */
    public function setLockedFlag($lockedFlag)
    {
        $this->lockedFlag = $lockedFlag;
    }

    /**
     * @return string
     */
    public function getDeletedFlag()
    {
        return $this->deletedFlag;
    }

    /**
     * @param string $deletedFlag
     */
    public function setDeletedFlag($deletedFlag)
    {
        $this->deletedFlag = $deletedFlag;
    }

    /**
     * @return Employer
     */
    public function getCurrentEmployer()
    {
        return $this->currentEmployer;
    }

    /**
     * @param Employer $currentEmployer
     */
    public function setCurrentEmployer(Employer $currentEmployer)
    {
        $this->currentEmployer = $currentEmployer;
    }

    /**
     * @return UserAuthentication
     */
    public function getUserAuthentications()
    {
        return $this->userAuthentications;
    }

    /**
     * @param UserAuthentication $userAuthentications
     */
    public function setUserAuthentications(UserAuthentication $userAuthentications)
    {
        $this->userAuthentications = $userAuthentications;
    }

    /**
     * @return JobSeeker
     */
    public function getJobSeeker()
    {
        return $this->jobSeeker;
    }

    /**
     * @param JobSeeker $jobSeeker
     */
    public function setJobSeeker(JobSeeker $jobSeeker)
    {
        $this->jobSeeker = $jobSeeker;
    }

    public function getValues()
    {
        return array(
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email
        );
    }


}