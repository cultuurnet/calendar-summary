<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:17
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;
use \DateTime;
use \DateTimeInterface;

class SmallPeriodFormatter implements PeriodFomatterInterface
{
    public function format(CultureFeed_Cdb_Data_Calendar_Period $period)
    {
        $startDate = $this->dateFromString($period->getDateFrom());
        $startDate->setTime(0, 0, 1);

        $now = new DateTime();

        if ($startDate > $now) {
            return $this->formatNotStarted($startDate);
        } else {
            $endDate = $this->dateFromString($period->getDateTo());
            return $this->formatStarted($endDate);
        }
    }

    /**
     * @param string $dateString
     * @return DateTime
     */
    private function dateFromString($dateString)
    {
        return DateTime::createFromFormat('Y-m-d', $dateString);
    }

    /**
     * @param DateTimeInterface $endDate
     * @return string
     */
    private function formatStarted(DateTimeInterface $endDate)
    {
        return
            '<span class="to meta">Tot</span> ' .
            $this->formatDate($endDate);
    }

    /**
     * @param DateTimeInterface $startDate
     * @return string
     */
    private function formatNotStarted(DateTimeInterface $startDate)
    {
        return
            '<span class="from meta">Vanaf</span> ' .
            $this->formatDate($startDate);
    }

    /**
     * @param DateTimeInterface $date
     * @return string
     */
    private function formatDate(DateTimeInterface $date)
    {
        $dateFromDay = $date->format('j');
        $dateFromMonth = $date->format('M');

        $output =
            '<span class="cf-date">' . $dateFromDay . '</span> ' .
            '<span class="cf-month">' . strtolower($dateFromMonth) . '</span>';

        return $output;
    }
}
