<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 25-3-15
 * Time: 13:38
 */

namespace CultuurNet\CalendarSummary\Timestamps;

class ExtraSmallTimestampsFormatter implements TimestampsFormatterInterface
{
    public function format(
        \CultureFeed_Cdb_Data_Calendar_TimestampList $timestampList
    ) {

        if (sizeof($timestampList)==1) {
            $timestamp = $timestampList->next();
            $dateFrom = $timestamp->getDate();

            $dateFromDay = date('j', strtotime($dateFrom));
            $dateFromMonth = date('m', strtotime($dateFrom));

            $output = '<span class="cf-date">' . $dateFromDay .
                      '</span>/<span class="cf-month">'
                      . $dateFromMonth . '</span>';

            return $output;
        } else {
            throw new Exception('xs format not supported for multiple timestamps.');
        }
    }
}
