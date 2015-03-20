<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:17
 */

namespace CultuurNet\CalendarSummary\Period;


class SmallPeriodFormatter implements PeriodFomatterInterface {

    public function format(
      \CultureFeed_Cdb_Data_Calendar_Period $period
    ) {
        $dateFrom = $period->getDateFrom();

        $dateFromDay = date('DD', strtotime($dateFrom));
        $dateFromMonth = date('M', strtotime($dateFrom));

        $output = '<span class="cf-date">' . $dateFromDay . '</span>/<span class="cf-month">' . $dateFromMonth . '</span>';

        return $output;
    }
}
