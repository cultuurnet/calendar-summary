<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 10:57
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use IntlDateFormatter;

class MediumTimestampsHTMLFormatter implements TimestampsFormatterInterface
{
    private $fmt;

    private $fmtDay;

    public function __construct()
    {
        $this->fmt = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM yyyy'
        );

        $this->fmtDay = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'eeee'
        );
    }

    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {
        $timestamps_count = iterator_count($timestampList);
        $timestampList->rewind();

        if ($timestamps_count == 1) {
            $timestamp = $timestampList->current();
            return $this->formatSingleTimestamp($timestamp);
        } else {
            return $this->formatMultipleTimestamps($timestampList, $timestamps_count);
        }
    }

    public function formatSingleTimestamp($timestamp)
    {
        $dateString = $timestamp->getDate();

        $date = strtotime($dateString);
        $intlDate = $this->fmt->format($date);
        $intlDateDay = $this->fmtDay->format($date);


        $output = '<span class="cf-weekday cf-meta">' . $intlDateDay . '</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">' . $intlDate . '</span>';

        return $output;
    }

    public function formatMultipleTimestamps($timestampList, $timestamps_count)
    {
        $output = '';

        for ($i = 0; $i < $timestamps_count; $i++) {
            if ($i == 0 || $i == $timestamps_count-1) {
                $timestamp = $timestampList->current();
                $dateString = $timestamp->getDate();

                $date = strtotime($dateString);
                $intlDate = $this->fmt->format($date);

                if ($i == 0) {
                    $firstDate = $intlDate;
                    $output .= '<span class="cf-from cf-meta">Van</span>';
                    $output .= ' ';
                }
                $output .= '<span class="cf-date">' . $intlDate . '</span>';
                if ($i == 0) {
                    $output .= ' ';
                    $output .= '<span class="cf-to cf-meta">tot</span>';
                    $output .= ' ';
                }
            }
            if ($i == $timestamps_count-1) {
                if ($firstDate == $intlDate) {
                    $intlDateDay = $this->fmtDay->format($date);
                    $output = '<span class="cf-weekday cf-meta">' . $intlDateDay . '</span>';
                    $output .= ' ';
                    $output .= '<span class="cf-date">' . $intlDate . '</span>';
                }
            }

            $timestampList->next();
        }

        return $output;
    }
}
