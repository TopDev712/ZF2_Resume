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
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 *
 * @Table(name="EMPLOYERS")
 * @Entity
 *
 * @author konerig
 */
class Employer extends BaseEntity
{

    const LOCKED_YES = "Y";
    const LOCKED_NO = "N";
    const DELETED_YES = "Y";
    const DELETED_NO = "N";


    /**
     *
     * @var integer $id
     * @Column(name="EMPLOYER_ID", type="integer",nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Column(name="EMPLOYER_NAME",type="string",length=255,nullable=false)
     *
     * @var string
     */
    private $employerName;

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
     * @Column(name="COUNTRY",type="string",length=100,nullable=true)
     *
     * @var string
     */
    private $country;

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
     * @ManyToMany(targetEntity="User", fetch="LAZY")
     * @JoinTable(name="USER_EMPLOYERS",
     *      joinColumns={@JoinColumn(name="FK_EMPLOYER_ID", referencedColumnName="EMPLOYER_ID")},
     *      inverseJoinColumns={@JoinColumn(name="FK_USER_ID", referencedColumnName="USER_ID")}
     *    )
     * @var ArrayCollection
     */
    private $employees;

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
    public function getEmployerName()
    {
        return $this->employerName;
    }

    /**
     * @param string $employerName
     */
    public function setEmployerName($employerName)
    {
        $this->employerName = $employerName;
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
        $this->state = $state;
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
     * @return ArrayCollection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param ArrayCollection $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }


}