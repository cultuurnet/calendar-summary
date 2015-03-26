<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 25-3-15
 * Time: 13:38
 */

namespace CultuurNet\CalendarSummary\Timestamps;

class SmallTimestampsFormatter implements TimestampsFormatterInterface
{
    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {


        if (sizeof($timestampList)==1) {
            $timestamp = $timestampList->current();
            $dateFrom = $timestamp->getDate();

            $dateFromDay = date('j', strtotime($dateFrom));
            $dateFromMonth = date('M', strtotime($dateFrom));

            $output = '<span class="cf-date">' . $dateFromDay . '</span> <span class="cf-month">'
                       . $dateFromMonth . '</span>';

            return $output;
        } else {
            throw new Exception('s format not supported for multiple timestamps.');
        }
    }
}
