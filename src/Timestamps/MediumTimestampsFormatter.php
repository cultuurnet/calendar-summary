<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 10:57
 */

namespace CultuurNet\CalendarSummary\Timestamps;

class MediumTimestampsFormatter implements TimestampsFormatterInterface
{
    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {
        $fmt = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM Y'
        );

        $fmt_day = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'eeee'
        );

        if (sizeof($timestampList)==1) {
            $timestamp = $timestampList->key();
            $dateString = $timestamp->getDate();

            $date = strtotime($dateString);
            $intlDate =$fmt->format($date);
            $intlDateDay =$fmt_day->format($date);


            $output = '<span class="cf-weekday cf-meta">' . $intlDateDay .
                      '</span> <span class="date">' . $intlDate . '</span>';
            return $output;
        } elseif (sizeof($timestampList) > 1) {
            foreach ($timestampList as $timestamp) {
                $dateString = $timestamp->getDate();

                $date = strtotime($dateString);
                $intlDate =$fmt->format($date);

                $output = '<span class="cf-weekday cf-meta">' . $intlDateDay .
                          '</span> <span class="date">' . $intlDate . '</span>';
            }

            return $output;
        }
    }
}
