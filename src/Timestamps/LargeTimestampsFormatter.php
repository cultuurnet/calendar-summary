<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:06
 */

namespace CultuurNet\CalendarSummary\Timestamps;

class LargeTimestampsFormatter implements TimestampsFormatterInterface
{
    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {
        if (sizeof($timestampList)==1) {
            $timestamp = $timestampList->key();
            $dateFrom = $timestamp->getDate();

            $dateFromDay = date('j', strtotime($dateFrom));
            $dateFromMonth = date('m', strtotime($dateFrom));
            $dateFromYear = date('Y', strtotime($dateFrom));
            $dayFromDay = date('l', strtotime($dateFrom));

            $output = '<span class="cf-weekday cf-meta">' . $dayFromDay . '</span> <span class="date">'
                . $dateFromDay . ' ' . $dateFromMonth . ' ' . $dateFromYear . '</span>';
            return $output;
        } elseif (sizeof($timestampList) > 1) {
        }
    }
}
