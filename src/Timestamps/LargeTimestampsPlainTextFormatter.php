<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 27/03/15
 * Time: 17:42
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use IntlDateFormatter;

class LargeTimestampsPlainTextFormatter
{
    private $fmt;

    private $fmtWeekDayLong;

    private $fmtWeekDayShort;

    private $fmtTime;

    public function __construct()
    {
        $this->fmt = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM Y'
        );

        $this->fmtWeekDayLong = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'EEEE'
        );

        $this->fmtWeekDayShort = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'EEEEEE'
        );

        $this->fmtTime = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'HH:mm'
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
        $date = $timestamp->getDate();
        $intlDate = $this->fmt->format(strtotime($date));
        $intlWeekDay = $this->fmtWeekDayLong->format(strtotime($date));
        $startTime = $timestamp->getStartTime();
        $intlStartTime = $this->fmtTime->format(strtotime($startTime));
        $endTime = $timestamp->getEndTime();
        $intlEndTime = $this->fmtTime->format(strtotime($endTime));

        $output = $intlWeekDay . ' ' . $intlDate . PHP_EOL;
        if (!empty($endTime)) {
            $output .= 'van ';
        } else {
            $output .= 'om ';
        }
        $output .= $intlStartTime;
        if (!empty($endTime)) {
            $output .= ' tot ' . $intlEndTime;
        }

        return $output;
    }

    public function formatMultipleTimestamps($timestampList, $timestamps_count)
    {
        $today = strtotime(date('Y-m-d') . ' 00:00:00');
        $output = '';

        for ($i = 0; $i < $timestamps_count; $i++) {
            $timestamp = $timestampList->current();
            $date = $timestamp->getDate();
            $intlDate = $this->fmt->format(strtotime($date));
            $intlWeekDay = $this->fmtWeekDayShort->format(strtotime($date));
            $startTime = $timestamp->getStartTime();
            $intlStartTime = $this->fmtTime->format(strtotime($startTime));
            $endTime = $timestamp->getEndTime();
            $intlEndTime = $this->fmtTime->format(strtotime($endTime));

            if (strtotime($date) >= $today) {
                $output .= $intlWeekDay . ' ' . $intlDate . PHP_EOL;
                if (!empty($endTime)) {
                    $output .= 'van ';
                } else {
                    $output .= 'om ';
                }
                $output .= $intlStartTime;
                if (!empty($endTime)) {
                    $output .= ' tot ' . $intlEndTime;
                }
                if ($i != $timestamps_count-1) {
                    $output .= PHP_EOL;
                }
            }

            $timestampList->next();
        }

        return $output;
    }
}
