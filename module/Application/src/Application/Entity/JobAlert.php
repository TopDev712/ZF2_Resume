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
 * @Table(name="JOB_ALERTS")
 * @Entity
 *
 * @author konerig
 */
class JobAlert extends BaseEntity
{

    const ENABLED_YES = "Y";
    const DISABLED_YES = "N";

    /**
     *
     * @var integer $id
     * @Column(name="JOB_ALERT_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="SETTING_JSON",type="text",nullable=false)
     *
     * @var string
     */
    private $settingJson; 
        
    /**
     * @Column(name="SEARCH_ID",type="text",nullable=true)
     *
     * @var string
     */
    private $searchId;

    /**
     * @Column(name="ENABLED_FLAG",type="string",length=1,nullable=false)
     *
     * @var string
     */
    private $enabledFlag = JobAlert::ENABLED_YES;

    /**
     * @ManyToOne(targetEntity="JobSeeker")
     * @JoinColumn(name="FK_JOB_SEEKER_ID", referencedColumnName="JOB_SEEKER_ID", nullable=true)
     * @var JobSeeker
     */
    private $jobSeeker;

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
    public function getSettingJson()
    {
        return $this->settingJson;
    }

    /**
     * @param string $settingJson
     */
    public function setSettingJson($settingJson)
    {
        $this->settingJson = $settingJson;
    }
        
    /**
     * @return string
     */
    public function getSearchId()
    {
    	return $this->searchId;
    }
    
    /**
     * @param string $searchId
     */
    public function setSearchId($searchId)
    {
    	$this->searchId = $searchId;
    }

    /**
     * @return string
     */
    public function getEnabledFlag()
    {
        return $this->enabledFlag;
    }

    /**
     * @param string $enabledFlag
     */
    public function setEnabledFlag($enabledFlag)
    {
        $this->enabledFlag = $enabledFlag;
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
    public function setJobSeeker($jobSeeker)
    {
        $this->jobSeeker = $jobSeeker;
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


}