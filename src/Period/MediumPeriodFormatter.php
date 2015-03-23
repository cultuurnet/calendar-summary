<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:16
 */

namespace CultuurNet\CalendarSummary\Period;

use IntlDateFormatter;

class MediumPeriodFormatter implements PeriodFomatterInterface
{

    public function format(
        \CultureFeed_Cdb_Data_Calendar_Period $period
    ) {
        $dateFrom = $period->getDateFrom();
        $dateFormatter = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'j F Y'
        );
        $intlDateFrom = $dateFormatter->format($dateFrom);

        $output = '<span class="cf-date">' . $dateFrom . '</span>';

        return $output;
    }
}
