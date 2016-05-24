<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Urltemplates
 *
 * @ORM\Table(name="URL_TEMPLATES")
 * @ORM\Entity
 */
class URLTemplate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="URLID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $urlid;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=256, nullable=true)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="TEMPLATEID", type="integer", nullable=true)
     */
    private $templateid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACTIVE", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="SUB_DOMAIN_ID", type="integer", nullable=true)
     */
    private $subDomainId;

    /**
     * @var string
     *
     * @ORM\Column(name="SITEDOMAIN", type="string", length=100, nullable=true)
     */
    private $sitedomain;

    /**
     * @var integer
     *
     * @ORM\Column(name="GOOGLEPRIORITY", type="smallint", nullable=true)
     */
    private $googlepriority;

    /**
     * @var string
     *
     * @ORM\Column(name="GJQ", type="string", length=256, nullable=true)
     */
    private $gjq;

    /**
     * @var string
     *
     * @ORM\Column(name="GJL", type="string", length=256, nullable=true)
     */
    private $gjl;

    /**
     * @var string
     *
     * @ORM\Column(name="GJJOBCATEGORY", type="string", length=10, nullable=true)
     */
    private $gjjobcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="INDEEDQ", type="string", length=256, nullable=true)
     */
    private $indeedq;

    /**
     * @var string
     *
     * @ORM\Column(name="INDEEDL", type="string", length=256, nullable=true)
     */
    private $indeedl;

    /**
     * @var integer
     *
     * @ORM\Column(name="INDEEDFROMAGE", type="smallint", nullable=true)
     */
    private $indeedfromage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="INDEEDHIGHLIGHT", type="boolean", nullable=true)
     */
    private $indeedhighlight;

    /**
     * @var string
     *
     * @ORM\Column(name="INDEEDCHANNEL", type="string", length=50, nullable=true)
     */
    private $indeedchannel;

    /**
     * @var string
     *
     * @ORM\Column(name="SEARCHTYPE", type="string", length=50, nullable=true)
     */
    private $searchtype;

    /**
     * @var string
     *
     * @ORM\Column(name="ZIPCODE", type="string", length=12, nullable=true)
     */
    private $zipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESULTTYPE", type="smallint", nullable=true)
     */
    private $resulttype;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGE_TITLE", type="string", length=384, nullable=true)
     */
    private $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGE_META_KEYWORDS", type="string", length=512, nullable=true)
     */
    private $pageMetaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGE_META_DESCRIPTION", type="string", length=512, nullable=true)
     */
    private $pageMetaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIMARY_KEYWORD_PHRASE", type="string", length=128, nullable=true)
     */
    private $primaryKeywordPhrase;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTAREA1", type="string", length=256, nullable=true)
     */
    private $textarea1;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTAREA2", type="string", length=256, nullable=true)
     */
    private $textarea2;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTAREA3", type="string", length=256, nullable=true)
     */
    private $textarea3;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTAREA4", type="string", length=256, nullable=true)
     */
    private $textarea4;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTAREA5", type="string", length=256, nullable=true)
     */
    private $textarea5;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXT_H1A", type="string", length=384, nullable=true)
     */
    private $textH1a;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTH1B", type="string", length=512, nullable=true)
     */
    private $texth1b;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTH2A", type="string", length=100, nullable=true)
     */
    private $texth2a;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXTH2B", type="string", length=256, nullable=true)
     */
    private $texth2b;

    /**
     * @var string
     *
     * @ORM\Column(name="NAVTEXT1", type="string", length=128, nullable=true)
     */
    private $navtext1;

    /**
     * @var string
     *
     * @ORM\Column(name="NAVKEYWORD1", type="string", length=50, nullable=true)
     */
    private $navkeyword1;

    /**
     * @var string
     *
     * @ORM\Column(name="NAVTEXT2", type="string", length=128, nullable=true)
     */
    private $navtext2;

    /**
     * @var string
     *
     * @ORM\Column(name="NAVKEYWORD2", type="string", length=50, nullable=true)
     */
    private $navkeyword2;

    /**
     * @var string
     *
     * @ORM\Column(name="RSSFEEDLINK", type="string", length=256, nullable=true)
     */
    private $rssfeedlink;

    /**
     * @var string
     *
     * @ORM\Column(name="RSSFEEDTEXT", type="string", length=128, nullable=true)
     */
    private $rssfeedtext;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TWITTERLINK", type="boolean", nullable=true)
     */
    private $twitterlink;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ARTICLES", type="boolean", nullable=true)
     */
    private $articles;

    /**
     * @var string
     *
     * @ORM\Column(name="VIDEOURLLINK", type="string", length=150, nullable=true)
     */
    private $videourllink;

    /**
     * @var string
     *
     * @ORM\Column(name="VIDEOTHUMBNAIL", type="string", length=150, nullable=true)
     */
    private $videothumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="VIDEODESCRIPTION", type="string", length=100, nullable=true)
     */
    private $videodescription;

    /**
     * @var string
     *
     * @ORM\Column(name="VIDEOLOGO", type="string", length=150, nullable=true)
     */
    private $videologo;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGELOGO", type="string", length=100, nullable=true)
     */
    private $pagelogo;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGECSS", type="string", length=100, nullable=true)
     */
    private $pagecss;

    /**
     * @var string
     *
     * @ORM\Column(name="SITEMAPFILE", type="string", length=50, nullable=true)
     */
    private $sitemapfile;

    /**
     * @var integer
     *
     * @ORM\Column(name="INCLUDEINBROWSE", type="smallint", nullable=true)
     */
    private $includeinbrowse;

    /**
     * @var string
     *
     * @ORM\Column(name="BROWSEFUNCTIONKEYWORD", type="string", length=50, nullable=true)
     */
    private $browsefunctionkeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="BROWSELOCATIONKEYWORD", type="string", length=50, nullable=true)
     */
    private $browselocationkeyword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATEDDATE", type="datetime", nullable=true)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MODIFIEDDATE", type="datetime", nullable=true)
     */
    private $modifieddate;

    /**
     * @var string
     *
     * @ORM\Column(name="LANDING_PAGE", type="string", length=100, nullable=true)
     */
    private $landingPage;



    /**
     * Get urlid
     *
     * @return integer
     */
    public function getUrlid()
    {
        return $this->urlid;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Urltemplates
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set templateid
     *
     * @param integer $templateid
     *
     * @return Urltemplates
     */
    public function setTemplateid($templateid)
    {
        $this->templateid = $templateid;

        return $this;
    }

    /**
     * Get templateid
     *
     * @return integer
     */
    public function getTemplateid()
    {
        return $this->templateid;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Urltemplates
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set subDomainId
     *
     * @param integer $subDomainId
     *
     * @return Urltemplates
     */
    public function setSubDomainId($subDomainId)
    {
        $this->subDomainId = $subDomainId;

        return $this;
    }

    /**
     * Get subDomainId
     *
     * @return integer
     */
    public function getSubDomainId()
    {
        return $this->subDomainId;
    }

    /**
     * Set sitedomain
     *
     * @param string $sitedomain
     *
     * @return Urltemplates
     */
    public function setSitedomain($sitedomain)
    {
        $this->sitedomain = $sitedomain;

        return $this;
    }

    /**
     * Get sitedomain
     *
     * @return string
     */
    public function getSitedomain()
    {
        return $this->sitedomain;
    }

    /**
     * Set googlepriority
     *
     * @param integer $googlepriority
     *
     * @return Urltemplates
     */
    public function setGooglepriority($googlepriority)
    {
        $this->googlepriority = $googlepriority;

        return $this;
    }

    /**
     * Get googlepriority
     *
     * @return integer
     */
    public function getGooglepriority()
    {
        return $this->googlepriority;
    }

    /**
     * Set gjq
     *
     * @param string $gjq
     *
     * @return Urltemplates
     */
    public function setGjq($gjq)
    {
        $this->gjq = $gjq;

        return $this;
    }

    /**
     * Get gjq
     *
     * @return string
     */
    public function getGjq()
    {
        return $this->gjq;
    }

    /**
     * Set gjl
     *
     * @param string $gjl
     *
     * @return Urltemplates
     */
    public function setGjl($gjl)
    {
        $this->gjl = $gjl;

        return $this;
    }

    /**
     * Get gjl
     *
     * @return string
     */
    public function getGjl()
    {
        return $this->gjl;
    }

    /**
     * Set gjjobcategory
     *
     * @param string $gjjobcategory
     *
     * @return Urltemplates
     */
    public function setGjjobcategory($gjjobcategory)
    {
        $this->gjjobcategory = $gjjobcategory;

        return $this;
    }

    /**
     * Get gjjobcategory
     *
     * @return string
     */
    public function getGjjobcategory()
    {
        return $this->gjjobcategory;
    }

    /**
     * Set indeedq
     *
     * @param string $indeedq
     *
     * @return Urltemplates
     */
    public function setIndeedq($indeedq)
    {
        $this->indeedq = $indeedq;

        return $this;
    }

    /**
     * Get indeedq
     *
     * @return string
     */
    public function getIndeedq()
    {
        return $this->indeedq;
    }

    /**
     * Set indeedl
     *
     * @param string $indeedl
     *
     * @return Urltemplates
     */
    public function setIndeedl($indeedl)
    {
        $this->indeedl = $indeedl;

        return $this;
    }

    /**
     * Get indeedl
     *
     * @return string
     */
    public function getIndeedl()
    {
        return $this->indeedl;
    }

    /**
     * Set indeedfromage
     *
     * @param integer $indeedfromage
     *
     * @return Urltemplates
     */
    public function setIndeedfromage($indeedfromage)
    {
        $this->indeedfromage = $indeedfromage;

        return $this;
    }

    /**
     * Get indeedfromage
     *
     * @return integer
     */
    public function getIndeedfromage()
    {
        return $this->indeedfromage;
    }

    /**
     * Set indeedhighlight
     *
     * @param boolean $indeedhighlight
     *
     * @return Urltemplates
     */
    public function setIndeedhighlight($indeedhighlight)
    {
        $this->indeedhighlight = $indeedhighlight;

        return $this;
    }

    /**
     * Get indeedhighlight
     *
     * @return boolean
     */
    public function getIndeedhighlight()
    {
        return $this->indeedhighlight;
    }

    /**
     * Set indeedchannel
     *
     * @param string $indeedchannel
     *
     * @return Urltemplates
     */
    public function setIndeedchannel($indeedchannel)
    {
        $this->indeedchannel = $indeedchannel;

        return $this;
    }

    /**
     * Get indeedchannel
     *
     * @return string
     */
    public function getIndeedchannel()
    {
        return $this->indeedchannel;
    }

    /**
     * Set searchtype
     *
     * @param string $searchtype
     *
     * @return Urltemplates
     */
    public function setSearchtype($searchtype)
    {
        $this->searchtype = $searchtype;

        return $this;
    }

    /**
     * Get searchtype
     *
     * @return string
     */
    public function getSearchtype()
    {
        return $this->searchtype;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Urltemplates
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set resulttype
     *
     * @param integer $resulttype
     *
     * @return Urltemplates
     */
    public function setResulttype($resulttype)
    {
        $this->resulttype = $resulttype;

        return $this;
    }

    /**
     * Get resulttype
     *
     * @return integer
     */
    public function getResulttype()
    {
        return $this->resulttype;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     *
     * @return Urltemplates
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set pageMetaKeywords
     *
     * @param string $pageMetaKeywords
     *
     * @return Urltemplates
     */
    public function setPageMetaKeywords($pageMetaKeywords)
    {
        $this->pageMetaKeywords = $pageMetaKeywords;

        return $this;
    }

    /**
     * Get pageMetaKeywords
     *
     * @return string
     */
    public function getPageMetaKeywords()
    {
        return $this->pageMetaKeywords;
    }

    /**
     * Set pageMetaDescription
     *
     * @param string $pageMetaDescription
     *
     * @return Urltemplates
     */
    public function setPageMetaDescription($pageMetaDescription)
    {
        $this->pageMetaDescription = $pageMetaDescription;

        return $this;
    }

    /**
     * Get pageMetaDescription
     *
     * @return string
     */
    public function getPageMetaDescription()
    {
        return $this->pageMetaDescription;
    }

    /**
     * Set primaryKeywordPhrase
     *
     * @param string $primaryKeywordPhrase
     *
     * @return Urltemplates
     */
    public function setPrimaryKeywordPhrase($primaryKeywordPhrase)
    {
        $this->primaryKeywordPhrase = $primaryKeywordPhrase;

        return $this;
    }

    /**
     * Get primaryKeywordPhrase
     *
     * @return string
     */
    public function getPrimaryKeywordPhrase()
    {
        return $this->primaryKeywordPhrase;
    }

    /**
     * Set textarea1
     *
     * @param string $textarea1
     *
     * @return Urltemplates
     */
    public function setTextarea1($textarea1)
    {
        $this->textarea1 = $textarea1;

        return $this;
    }

    /**
     * Get textarea1
     *
     * @return string
     */
    public function getTextarea1()
    {
        return $this->textarea1;
    }

    /**
     * Set textarea2
     *
     * @param string $textarea2
     *
     * @return Urltemplates
     */
    public function setTextarea2($textarea2)
    {
        $this->textarea2 = $textarea2;

        return $this;
    }

    /**
     * Get textarea2
     *
     * @return string
     */
    public function getTextarea2()
    {
        return $this->textarea2;
    }

    /**
     * Set textarea3
     *
     * @param string $textarea3
     *
     * @return Urltemplates
     */
    public function setTextarea3($textarea3)
    {
        $this->textarea3 = $textarea3;

        return $this;
    }

    /**
     * Get textarea3
     *
     * @return string
     */
    public function getTextarea3()
    {
        return $this->textarea3;
    }

    /**
     * Set textarea4
     *
     * @param string $textarea4
     *
     * @return Urltemplates
     */
    public function setTextarea4($textarea4)
    {
        $this->textarea4 = $textarea4;

        return $this;
    }

    /**
     * Get textarea4
     *
     * @return string
     */
    public function getTextarea4()
    {
        return $this->textarea4;
    }

    /**
     * Set textarea5
     *
     * @param string $textarea5
     *
     * @return Urltemplates
     */
    public function setTextarea5($textarea5)
    {
        $this->textarea5 = $textarea5;

        return $this;
    }

    /**
     * Get textarea5
     *
     * @return string
     */
    public function getTextarea5()
    {
        return $this->textarea5;
    }

    /**
     * Set textH1a
     *
     * @param string $textH1a
     *
     * @return Urltemplates
     */
    public function setTextH1a($textH1a)
    {
        $this->textH1a = $textH1a;

        return $this;
    }

    /**
     * Get textH1a
     *
     * @return string
     */
    public function getTextH1a()
    {
        return $this->textH1a;
    }

    /**
     * Set texth1b
     *
     * @param string $texth1b
     *
     * @return Urltemplates
     */
    public function setTexth1b($texth1b)
    {
        $this->texth1b = $texth1b;

        return $this;
    }

    /**
     * Get texth1b
     *
     * @return string
     */
    public function getTexth1b()
    {
        return $this->texth1b;
    }

    /**
     * Set texth2a
     *
     * @param string $texth2a
     *
     * @return Urltemplates
     */
    public function setTexth2a($texth2a)
    {
        $this->texth2a = $texth2a;

        return $this;
    }

    /**
     * Get texth2a
     *
     * @return string
     */
    public function getTexth2a()
    {
        return $this->texth2a;
    }

    /**
     * Set texth2b
     *
     * @param string $texth2b
     *
     * @return Urltemplates
     */
    public function setTexth2b($texth2b)
    {
        $this->texth2b = $texth2b;

        return $this;
    }

    /**
     * Get texth2b
     *
     * @return string
     */
    public function getTexth2b()
    {
        return $this->texth2b;
    }

    /**
     * Set navtext1
     *
     * @param string $navtext1
     *
     * @return Urltemplates
     */
    public function setNavtext1($navtext1)
    {
        $this->navtext1 = $navtext1;

        return $this;
    }

    /**
     * Get navtext1
     *
     * @return string
     */
    public function getNavtext1()
    {
        return $this->navtext1;
    }

    /**
     * Set navkeyword1
     *
     * @param string $navkeyword1
     *
     * @return Urltemplates
     */
    public function setNavkeyword1($navkeyword1)
    {
        $this->navkeyword1 = $navkeyword1;

        return $this;
    }

    /**
     * Get navkeyword1
     *
     * @return string
     */
    public function getNavkeyword1()
    {
        return $this->navkeyword1;
    }

    /**
     * Set navtext2
     *
     * @param string $navtext2
     *
     * @return Urltemplates
     */
    public function setNavtext2($navtext2)
    {
        $this->navtext2 = $navtext2;

        return $this;
    }

    /**
     * Get navtext2
     *
     * @return string
     */
    public function getNavtext2()
    {
        return $this->navtext2;
    }

    /**
     * Set navkeyword2
     *
     * @param string $navkeyword2
     *
     * @return Urltemplates
     */
    public function setNavkeyword2($navkeyword2)
    {
        $this->navkeyword2 = $navkeyword2;

        return $this;
    }

    /**
     * Get navkeyword2
     *
     * @return string
     */
    public function getNavkeyword2()
    {
        return $this->navkeyword2;
    }

    /**
     * Set rssfeedlink
     *
     * @param string $rssfeedlink
     *
     * @return Urltemplates
     */
    public function setRssfeedlink($rssfeedlink)
    {
        $this->rssfeedlink = $rssfeedlink;

        return $this;
    }

    /**
     * Get rssfeedlink
     *
     * @return string
     */
    public function getRssfeedlink()
    {
        return $this->rssfeedlink;
    }

    /**
     * Set rssfeedtext
     *
     * @param string $rssfeedtext
     *
     * @return Urltemplates
     */
    public function setRssfeedtext($rssfeedtext)
    {
        $this->rssfeedtext = $rssfeedtext;

        return $this;
    }

    /**
     * Get rssfeedtext
     *
     * @return string
     */
    public function getRssfeedtext()
    {
        return $this->rssfeedtext;
    }

    /**
     * Set twitterlink
     *
     * @param boolean $twitterlink
     *
     * @return Urltemplates
     */
    public function setTwitterlink($twitterlink)
    {
        $this->twitterlink = $twitterlink;

        return $this;
    }

    /**
     * Get twitterlink
     *
     * @return boolean
     */
    public function getTwitterlink()
    {
        return $this->twitterlink;
    }

    /**
     * Set articles
     *
     * @param boolean $articles
     *
     * @return Urltemplates
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return boolean
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set videourllink
     *
     * @param string $videourllink
     *
     * @return Urltemplates
     */
    public function setVideourllink($videourllink)
    {
        $this->videourllink = $videourllink;

        return $this;
    }

    /**
     * Get videourllink
     *
     * @return string
     */
    public function getVideourllink()
    {
        return $this->videourllink;
    }

    /**
     * Set videothumbnail
     *
     * @param string $videothumbnail
     *
     * @return Urltemplates
     */
    public function setVideothumbnail($videothumbnail)
    {
        $this->videothumbnail = $videothumbnail;

        return $this;
    }

    /**
     * Get videothumbnail
     *
     * @return string
     */
    public function getVideothumbnail()
    {
        return $this->videothumbnail;
    }

    /**
     * Set videodescription
     *
     * @param string $videodescription
     *
     * @return Urltemplates
     */
    public function setVideodescription($videodescription)
    {
        $this->videodescription = $videodescription;

        return $this;
    }

    /**
     * Get videodescription
     *
     * @return string
     */
    public function getVideodescription()
    {
        return $this->videodescription;
    }

    /**
     * Set videologo
     *
     * @param string $videologo
     *
     * @return Urltemplates
     */
    public function setVideologo($videologo)
    {
        $this->videologo = $videologo;

        return $this;
    }

    /**
     * Get videologo
     *
     * @return string
     */
    public function getVideologo()
    {
        return $this->videologo;
    }

    /**
     * Set pagelogo
     *
     * @param string $pagelogo
     *
     * @return Urltemplates
     */
    public function setPagelogo($pagelogo)
    {
        $this->pagelogo = $pagelogo;

        return $this;
    }

    /**
     * Get pagelogo
     *
     * @return string
     */
    public function getPagelogo()
    {
        return $this->pagelogo;
    }

    /**
     * Set pagecss
     *
     * @param string $pagecss
     *
     * @return Urltemplates
     */
    public function setPagecss($pagecss)
    {
        $this->pagecss = $pagecss;

        return $this;
    }

    /**
     * Get pagecss
     *
     * @return string
     */
    public function getPagecss()
    {
        return $this->pagecss;
    }

    /**
     * Set sitemapfile
     *
     * @param string $sitemapfile
     *
     * @return Urltemplates
     */
    public function setSitemapfile($sitemapfile)
    {
        $this->sitemapfile = $sitemapfile;

        return $this;
    }

    /**
     * Get sitemapfile
     *
     * @return string
     */
    public function getSitemapfile()
    {
        return $this->sitemapfile;
    }

    /**
     * Set includeinbrowse
     *
     * @param integer $includeinbrowse
     *
     * @return Urltemplates
     */
    public function setIncludeinbrowse($includeinbrowse)
    {
        $this->includeinbrowse = $includeinbrowse;

        return $this;
    }

    /**
     * Get includeinbrowse
     *
     * @return integer
     */
    public function getIncludeinbrowse()
    {
        return $this->includeinbrowse;
    }

    /**
     * Set browsefunctionkeyword
     *
     * @param string $browsefunctionkeyword
     *
     * @return Urltemplates
     */
    public function setBrowsefunctionkeyword($browsefunctionkeyword)
    {
        $this->browsefunctionkeyword = $browsefunctionkeyword;

        return $this;
    }

    /**
     * Get browsefunctionkeyword
     *
     * @return string
     */
    public function getBrowsefunctionkeyword()
    {
        return $this->browsefunctionkeyword;
    }

    /**
     * Set browselocationkeyword
     *
     * @param string $browselocationkeyword
     *
     * @return Urltemplates
     */
    public function setBrowselocationkeyword($browselocationkeyword)
    {
        $this->browselocationkeyword = $browselocationkeyword;

        return $this;
    }

    /**
     * Get browselocationkeyword
     *
     * @return string
     */
    public function getBrowselocationkeyword()
    {
        return $this->browselocationkeyword;
    }

    /**
     * Set createddate
     *
     * @param \DateTime $createddate
     *
     * @return Urltemplates
     */
    public function setCreateddate($createddate)
    {
        $this->createddate = $createddate;

        return $this;
    }

    /**
     * Get createddate
     *
     * @return \DateTime
     */
    public function getCreateddate()
    {
        return $this->createddate;
    }

    /**
     * Set modifieddate
     *
     * @param \DateTime $modifieddate
     *
     * @return Urltemplates
     */
    public function setModifieddate($modifieddate)
    {
        $this->modifieddate = $modifieddate;

        return $this;
    }

    /**
     * Get modifieddate
     *
     * @return \DateTime
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * Set landingPage
     *
     * @param string $landingPage
     *
     * @return Urltemplates
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;

        return $this;
    }

    /**
     * Get landingPage
     *
     * @return string
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }
}
