<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:38
 */

namespace CultuurNet\CalendarSummary;


class LargePermanentFormatter implements PermanentFormatterInterface {

    public function format(
      \CultureFeed_Cdb_Data_Calendar_Permanent $permanent
    ) {
        // Get opening info.
        // And group days with same openingtimes.
        $weekscheme = $permanent->getWeekScheme();
        $days = $weekscheme->getDays();

        foreach ($days as $day) {
          $openingtimes = $day->getOpeningTimes();
          // Every opening time has openFrom and openTill property.
        }



        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= 'meta itemprop="openingHours" content="">';

        return $output;

    }
}