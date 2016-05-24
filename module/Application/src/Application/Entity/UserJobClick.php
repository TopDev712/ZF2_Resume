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
 * @Table(name="USER_JOB_CLICKS")
 * @Entity
 *
 * @author konerig
 */
class UserJobClick extends BaseEntity
{

    /**
     *
     * @var integer $id
     * @Column(name="USER_JOB_CLICK_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="JOB_JSON",type="text",nullable=false)
     *
     * @var string
     */
    private $jobJson;

    /**
     * @Column(name="DATETIME_CREATED",type="datetime",nullable=false)
     *
     * @var string
     */
    private $dateTimeCreated;

    /**
     * @ManyToOne(targetEntity="UserSearchHistory")
     * @JoinColumn(name="FK_USER_SEARCH_HISTORY_ID", referencedColumnName="USER_SEARCH_HISTORY_ID", nullable=false)
     * @var User
     */
    private $userSearchHistory;

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
    public function getJobJson()
    {
        return $this->jobJson;
    }

    /**
     * @param string $jobJson
     */
    public function setJobJson($jobJson)
    {
        $this->jobJson = $jobJson;
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
     * @return User
     */
    public function getUserSearchHistory()
    {
        return $this->userSearchHistory;
    }

    /**
     * @param User $userSearchHistory
     */
    public function setUserSearchHistory($userSearchHistory)
    {
        $this->userSearchHistory = $userSearchHistory;
    }
}