<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:16
 */

namespace CultuurNet\CalendarSummary\Period;

use IntlDateFormatter;

class MediumPeriodPlainTextFormatter implements PeriodFormatterInterface
{

    public function format(
        \CultureFeed_Cdb_Data_Calendar_Period $period
    ) {
        $fmt = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM Y'
        );
        $dateFromString = $period->getDateFrom();
        $dateFrom = strtotime($dateFromString);
        $intlDateFrom =$fmt->format($dateFrom);

        $dateToString = $period->getDateTo();
        $dateTo = strtotime($dateToString);
        $intlDateTo = $fmt->format($dateTo);

        $output = 'Van ' . $intlDateFrom . ' tot '. $intlDateTo;

        return $output;
    }
}
