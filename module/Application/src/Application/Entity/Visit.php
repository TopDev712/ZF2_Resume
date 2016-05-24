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
 * @Table(name="VISITS")
 * @Entity(repositoryClass="\Application\Repository\VisitRepository")
 *
 * @author konerig
 */
class Visit extends BaseEntity
{

    /**
     *
     * @var integer $id
     * @Column(name="VISIT_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="IP",type="string",length=50,nullable=false)
     *
     * @var string
     */
    private $ip;

    /**
     * @Column(name="USER_AGENT",type="string",length=500,nullable=false)
     *
     * @var string
     */
    private $userAgent;

    /**
     * @Column(name="REFERENCE_URL",type="string",length=500,nullable=false)
     *
     * @var string
     */
    private $referenceUrl;

    /**
     * @Column(name="refPromoCode",type="string",length=100,nullable=false)
     *
     * @var string
     */
    private $refPromoCode;

    /**
     * @Column(name="DATETIME_CREATED",type="datetime",nullable=false)
     *
     * @var string
     */
    private $dateTimeCreated;

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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getReferenceUrl()
    {
        return $this->referenceUrl;
    }

    /**
     * @param string $referenceUrl
     */
    public function setReferenceUrl($referenceUrl)
    {
        $this->referenceUrl = $referenceUrl;
    }

    /**
     * @return string
     */
    public function getRefPromoCode()
    {
        return $this->refPromoCode;
    }

    /**
     * @param string $refPromoCode
     */
    public function setRefPromoCode($refPromoCode)
    {
        $this->refPromoCode = $refPromoCode;
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

}