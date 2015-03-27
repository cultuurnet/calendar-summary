<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:06
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use IntlDateFormatter;

class LargeTimestampsHTMLFormatter implements TimestampsFormatterInterface
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

        $output = '<time itemprop="startDate" datetime="' . $date . 'T' . $intlStartTime . '">';
        $output .= '<span class="cf-weekday cf-meta">' . $intlWeekDay . '</span>';
        $output .= '<span class="cf-date">' . $intlDate . '</span>';
        if (!empty($endTime)) {
            $output .= '<span class="cf-from cf-meta">van</span>';
        } else {
            $output .= '<span class="cf-from cf-meta">om</span>';
        }
        $output .= '<span class="cf-time">' . $intlStartTime . '</span>';
        $output .= '</time>';
        if (!empty($endTime)) {
            $output .= '<span class="cf-to cf-meta">tot</span>';
            $output .= '<time itemprop="endDate" datetime="' . $date . 'T' . $intlEndTime . '">';
            $output .= '<span class="cf-time">' . $intlEndTime . '</span>';
            $output .= '</time>';
        }

        return $output;
    }

    public function formatMultipleTimestamps($timestampList, $timestamps_count)
    {
        $today = strtotime(date('Y-m-d') . ' 00:00:00');

        $output = '<ul class="list-unstyled">';

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
                $output .= '<li>';
                $output .= '<time itemprop="startDate" datetime="' . $date . 'T' . $intlStartTime . '">';
                $output .= '<span class="cf-weekday cf-meta">' . $intlWeekDay . '</span>';
                $output .= '<span class="cf-date">' . $intlDate . '</span>';
                if (!empty($endTime)) {
                    $output .= '<span class="cf-from cf-meta">van</span>';
                } else {
                    $output .= '<span class="cf-from cf-meta">om</span>';
                }
                $output .= '<span class="cf-time">' . $intlStartTime . '</span>';
                $output .= '</time>';
                if (!empty($endTime)) {
                    $output .= '<span class="cf-to cf-meta">tot</span>';
                    $output .= '<time itemprop="endDate" datetime="' . $date . 'T' . $intlEndTime . '">';
                    $output .= '<span class="cf-time">' . $intlEndTime . '</span>';
                    $output .= '</time>';
                }

                $output .= '</li>';
            }

            $timestampList->next();
        }

        $output .= '</ul>';

        return $output;
    }
}
