<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:16
 */

namespace CultuurNet\CalendarSummary\Period;

use IntlDateFormatter;

class MediumPeriodHTMLFormatter implements PeriodFormatterInterface
{
    private $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    public function format(
        \CultureFeed_Cdb_Data_Calendar_PeriodList $periodList
    ) {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM yyyy'
        );

        $fmtDay = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'eeee'
        );

        $period = $periodList->current();
        $dateFromString = $period->getDateFrom();
        $dateFrom = strtotime($dateFromString);
        $intlDateFrom =$fmt->format($dateFrom);
        $intlDateFromDay = $fmtDay->format($dateFrom);

        $dateToString = $period->getDateTo();
        $dateTo = strtotime($dateToString);
        $intlDateTo = $fmt->format($dateTo);

        if ($intlDateFrom == $intlDateTo) {
            $output = '<span class="cf-weekday cf-meta">' . $intlDateFromDay . '</span>';
            $output .= ' ';
            $output .= '<span class="cf-date">' . $intlDateFrom . '</span>';
        } else {
            $output = '<span class="cf-from cf-meta">Van</span> <span class="cf-date">' . $intlDateFrom . '</span> ';
            $output .= '<span class="cf-to cf-meta">tot</span> <span class="cf-date">'. $intlDateTo . '</span>';
        }

        return $output;
    }
}
