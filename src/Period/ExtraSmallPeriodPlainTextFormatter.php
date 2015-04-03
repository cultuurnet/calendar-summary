<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 31/03/15
 * Time: 10:31
 */

namespace CultuurNet\CalendarSummary\Period;

class ExtraSmallPeriodPlainTextFormatter implements PeriodFormatterInterface
{
    public function format(
        \CultureFeed_Cdb_Data_Calendar_PeriodList $periodList
    ) {
        $period = $periodList->current();
        $dateFrom = $period->getDateFrom();

        $dateFromDay = date('j', strtotime($dateFrom));
        $dateFromMonth = date('m', strtotime($dateFrom));

        $output = $dateFromDay . '/' . $dateFromMonth;

        return $output;
    }
}
