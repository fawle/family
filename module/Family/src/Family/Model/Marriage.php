<?php

namespace Family\Model;

use \DateTime;

class Marriage
{
    /** @var  Datetime */
    protected $startDate;
    /** @var  Datetime */
    protected $endDate;

    function __construct($endDate = null, $startDate = null)
    {
        $date = new DateTime();

        if (!$startDate instanceof DateTime) {
            $startDate = $date->createFromFormat("Y-m-d", $startDate);
        }
        if ($endDate) {
            $this->startDate = $startDate;
        }

        if (!$endDate instanceof DateTime) {
            $endDate = $date->createFromFormat("Y-m-d", $endDate);
        }
        if ($endDate) {
            $this->endDate = $endDate;
        }


    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }


}