<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 25-3-15
 * Time: 13:38
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use CultuurNet\CalendarSummary\FormatterException;
use IntlDateFormatter;

class SmallTimestampsHTMLFormatter implements TimestampsFormatterInterface
{
    private $fmtDay;

    private $fmtMonth;

    public function __construct($locale = 'nl_BE')
    {
        $this->fmtDay = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd'
        );

        $this->fmtMonth = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'MMM'
        );
    }

    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {
        $timestamps_count = iterator_count($timestampList);
        $timestampList->rewind();

        if ($timestamps_count == 1) {
            $timestamp = $timestampList->current();
            $dateFrom = $timestamp->getDate();

            $dateFromDay = $this->fmtDay->format(strtotime($dateFrom));
            $dateFromMonth = $this->fmtMonth->format(strtotime($dateFrom));
            $dateFromMonth = rtrim($dateFromMonth, ".");

            $output = '<span class="cf-date">' . $dateFromDay . '</span>';
            $output .= ' ';
            $output .= '<span class="cf-month">' . $dateFromMonth . '</span>';

            return $output;
        } else {
            throw new FormatterException('sm format not supported for multiple timestamps.');
        }
    }
}
