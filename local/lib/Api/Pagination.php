<?php


namespace App\Api;


use CIBlockResult;
use JsonSerializable;

class Pagination implements JsonSerializable
{
    private $iNumPage;
    private $nPageSize;
    private $checkOutOfRange;

    private $navPageCount;
    private $navPageSize;
    private $navRecordCount;
    private $pagen;
    private $nStartPage;
    private $nEndPage;
    private $navPageNomer;

    private static $instance;

    private function __construct($iNumPage = 1, $nPageSize = 5, $checkOutOfRange = true)
    {
        $this->iNumPage = $iNumPage;
        $this->nPageSize = $nPageSize;
        $this->checkOutOfRange = $checkOutOfRange;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) self::$instance = new Pagination();

        return self::$instance;
    }

    /**
     * @param Pagination $navParams
     * @param CIBlockResult $result
     * @return Pagination|bool
     */
    public function getPaginationData(Pagination $navParams, CIBlockResult $result)
    {
        if ($navParams == NULL) return false;

        return $navParams->setNavPageCount($result->NavPageCount)
            ->setNavPageSize($result->NavPageSize)
            ->setNavRecordCount($result->NavRecordCount)
            ->setPagen($result->PAGEN)
            ->setNStartPage($result->nStartPage)
            ->setNEndPage($result->nEndPage)
            ->setNavPageNomer($result->NavPageNomer);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'pages' => $this->getNavPageCount(),
            'pageNumber' => $this->getNavPageNomer(),
            'countItemsOnPage' => $this->getNavPageSize(),
            'totalItems' => $this->getNavRecordCount()
        ];
    }

    /**
     * @return mixed
     */
    public function getNavPageCount()
    {
        return $this->navPageCount;
    }

    /**
     * @param mixed $navPageCount
     * @return Pagination
     */
    public function setNavPageCount($navPageCount): Pagination
    {
        $this->navPageCount = $navPageCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavPageSize()
    {
        return $this->navPageSize;
    }

    /**
     * @param mixed $navPageSize
     * @return Pagination
     */
    public function setNavPageSize($navPageSize): Pagination
    {
        $this->navPageSize = $navPageSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavRecordCount()
    {
        return $this->navRecordCount;
    }

    /**
     * @param mixed $navRecordCount
     * @return Pagination
     */
    public function setNavRecordCount($navRecordCount): Pagination
    {
        $this->navRecordCount = $navRecordCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagen()
    {
        return $this->pagen;
    }

    /**
     * @param mixed $pagen
     * @return Pagination
     */
    public function setPagen($pagen): Pagination
    {
        $this->pagen = $pagen;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNStartPage()
    {
        return $this->nStartPage;
    }

    /**
     * @param mixed $nStartPage
     * @return Pagination
     */
    public function setNStartPage($nStartPage): Pagination
    {
        $this->nStartPage = $nStartPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNEndPage()
    {
        return $this->nEndPage;
    }

    /**
     * @param mixed $nEndPage
     * @return Pagination
     */
    public function setNEndPage($nEndPage): Pagination
    {
        $this->nEndPage = $nEndPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavPageNomer()
    {
        return $this->navPageNomer;
    }

    /**
     * @param mixed $navPageNomer
     * @return Pagination
     */
    public function setNavPageNomer($navPageNomer): Pagination
    {
        $this->navPageNomer = $navPageNomer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getINumPage()
    {
        return $this->iNumPage;
    }

    /**
     * @param mixed $iNumPage
     * @return Pagination
     */
    public function setINumPage($iNumPage): Pagination
    {
        $this->iNumPage = $iNumPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNPageSize()
    {
        return $this->nPageSize;
    }

    /**
     * @param mixed $nPageSize
     * @return Pagination
     */
    public function setNPageSize($nPageSize): Pagination
    {
        $this->nPageSize = $nPageSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckOutOfRange()
    {
        return $this->checkOutOfRange;
    }

    /**
     * @param mixed $checkOutOfRange
     * @return Pagination
     */
    public function setCheckOutOfRange($checkOutOfRange): Pagination
    {
        $this->checkOutOfRange = $checkOutOfRange;
        return $this;
    }
}