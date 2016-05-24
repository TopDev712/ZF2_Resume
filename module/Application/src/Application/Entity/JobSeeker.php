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
 * @Table(name="JOB_SEEKERS")
 * @Entity
 *
 * @author konerig
 */
class JobSeeker extends BaseEntity
{

    /**
     *
     * @var integer $id
     * @Column(name="JOB_SEEKER_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="FK_USER_ID", referencedColumnName="USER_ID", nullable=true)
     * @var User
     */
    private $user;
    
    /**
     * @Column(name="SUBSCRIBER_ID",type="text",nullable=true)
     *
     * @var string
     */
    private $subscriberId;
    
    /**
     * @Column(name="PHONE_NO",type="text",nullable=true)
     *
     * @var string
     */
    private $phoneNo;
    
    /**
     * @Column(name="INDUSTRY",type="text",nullable=true)
     *
     * @var string
     */
    private $industry;
    
    /**
     * @Column(name="HEADLINE",type="text",nullable=true)
     *
     * @var string
     */
    private $headline;
    
    /**
     * @Column(name="EXPERIENCE",type="text",nullable=true)
     *
     * @var string
     */
    private $experience;
    
    /**
     * @Column(name="EDUCATION",type="text",nullable=true)
     *
     * @var string
     */
    private $education;
    
    /**
     * @Column(name="DESIRED_SALARY",type="text",nullable=true)
     *
     * @var string
     */
    private $desiredSalary;
    
    /**
     * @Column(name="COUNTRY",type="text",nullable=true)
     *
     * @var string
     */
    private $country;
    
    /**
     * @Column(name="ZIP_CODE",type="text",nullable=true)
     *
     * @var string
     */
    private $zipCode;
    
    /**
     * @Column(name="LINKEDIN",type="text",nullable=true)
     *
     * @var string
     */
    private $linkedin;
    
    /**
     * @Column(name="TWITTER",type="text",nullable=true)
     *
     * @var string
     */
    private $twitter;
    
    /**
     * @Column(name="FACEBOOK",type="text",nullable=true)
     *
     * @var string
     */
    private $facebook;
    
    /**
     * @Column(name="COMPANY_FIND_FLAG",type="text",nullable=true)
     *
     * @var string
     */
    private $companyFindFlag;

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

    /**
     * @return string
     */
    public function getSubscriberId()
    {
    	return $this->subscriberId;
    }
    
    /**
     * @param string $subscriberId
     */
    public function setSubscriberId($subscriberId)
    {
    	$this->subscriberId = $subscriberId;
    }
    /**
     * @return string
     */
    public function getPhoneNo()
    {
    	return $this->phoneNo;
    }
    
    /**
     * @param string $phoneNo
     */
    public function setPhoneNo($phoneNo)
    {
    	$this->phoneNo = $phoneNo;
    }
    
    /**
     * @return string
     */
    public function getIndustry()
    {
    	return $this->industry;
    }
    
    /**
     * @param string $industry
     */
    public function setIndustry($industry)
    {
    	$this->industry = $industry;
    }
    
    /**
     * @return string
     */
    public function getHeadline()
    {
    	return $this->headline;
    }
    
    /**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
    	$this->headline = $headline;
    }
    
    /**
     * @return string
     */
    public function getExperience()
    {
    	return $this->experience;
    }
    
    /**
     * @param string $experience
     */
    public function setExperience($experience)
    {
    	$this->experience = $experience;
    }
    
    /**
     * @return string
     */
    public function getEducation()
    {
    	return $this->education;
    }
    
    /**
     * @param string $education
     */
    public function setEducation($education)
    {
    	$this->education = $education;
    }
    
    /**
     * @return string
     */
    public function getDesiredSalary()
    {
    	return $this->desiredSalary;
    }
    
    /**
     * @param string $desiredSalary
     */
    public function setDesiredSalary($desiredSalary)
    {
    	$this->desiredSalary = $desiredSalary;
    }
    
    /**
     * @return string
     */
    public function getCountry()
    {
    	return $this->country;
    }
    
    /**
     * @param string $country
     */
    public function setCountry($country)
    {
    	$this->country = $country;
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
    public function getLinkedin()
    {
    	return $this->linkedin;
    }
    
    /**
     * @param string $linkedin
     */
    public function setLinkedin($linkedin)
    {
    	$this->linkedin = $linkedin;
    }
    
    /**
     * @return string
     */
    public function getTwitter()
    {
    	return $this->twitter;
    }
    
    /**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
    	$this->twitter = $twitter;
    }
    
    /**
     * @return string
     */
    public function getFacebook()
    {
    	return $this->facebook;
    }
    
    /**
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
    	$this->facebook = $facebook;
    }
    
    /**
     * @return string
     */
    public function getCompanyFindFlag()
    {
    	return $this->companyFindFlag;
    }
    
    /**
     * @param string $companyFindFlag
     */
    public function setCompanyFindFlag($companyFindFlag)
    {
    	$this->companyFindFlag = $companyFindFlag;
    }
}