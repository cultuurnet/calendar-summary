<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:18
 */

namespace CultuurNet\CalendarSummary\Period;

class ExtraSmallPeriodHTMLFormatter implements PeriodFormatterInterface
{

    public function format(
        \CultureFeed_Cdb_Data_Calendar_PeriodList $periodList
    ) {
        $period = $periodList->current();
        $dateFrom = $period->getDateFrom();

        $dateFromDay = date('j', strtotime($dateFrom));
        $dateFromMonth = date('m', strtotime($dateFrom));

        $output = '<span class="cf-date">' . $dateFromDay . '</span>/<span class="cf-month">'
                  . $dateFromMonth . '</span>';

        return $output;
    }
}
