<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:15
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_SchemeDay as SchemeDay;
use IntlDateFormatter;

class LargePeriodFormatter implements PeriodFomatterInterface
{

    public function format(
        \CultureFeed_Cdb_Data_Calendar_Period $period
    ) {
        $fmt = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'd MMMM Y'
        );
        $dateFromString = $period->getDateFrom();
        $dateFrom = strtotime($dateFromString);
        $intlDateFrom =$fmt->format($dateFrom);

        $dateToString = $period->getDateTo();
        $dateTo = strtotime($dateToString);
        $intlDateTo = $fmt->format($dateTo);

        $output = '<p>';
        $output .= '<time itemprop="startDate" datetime="' . $dateFrom . '">';
        $output .= '<span class="cf-date">' . $intlDateFrom . '</span>';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= '<time itemprop="endDate" datetime="' . $dateTo . '">';
        $output .= '<span class="cf-date">' . $intlDateTo . '</span>';
        $output .= '</p>';

        $output .= '<p>Openingsuren:</p>';
        $output .= '<ul class="list-unstyled">';

        $weekscheme = $period->getWeekScheme();

        $keys = array_keys($weekscheme->getDays());


        for ($i = 0; $i <= 6; $i++) {
            $one_day = $weekscheme->getDays()[$keys[$i]];
            if (!is_null($one_day) && $one_day->getOpenType()==SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN) {
                $previous=null;
                if ($one_day->getDayName()!=SchemeDay::MONDAY) {
                    $previous = $weekscheme->getDays()[$keys[$i - 1]];
                }
                if (!is_null($previous) &&
                    $previous->getOpenType()==$one_day->getOpenType() &&
                    $previous->getOpeningTimes()==$one_day->getOpeningTimes()) {
                    if (strpos($output, '- ' . $previous->getDayName() . '</span>' !== false)) {
                        $output = str_replace(
                            '- ' . $previous->getDayName() . '</span>',
                            '- ' . $one_day->getDayName() . '</span>',
                            $output
                        );
                    } else {
                        $output = str_replace(
                            $previous->getDayName() . '</span>',
                            $previous->getDayName() . ' - ' . $one_day->getDayName() . '</span>',
                            $output
                        );
                    }
                } else {
                    $output .= '<li>';
                    $output .= '<meta itemprop="openingHours" content="' . 'TEMP' . '">';
                    $output .= '<span class="cf-days">' . $one_day->getDayName() . '</span>';
                    if (!is_null($one_day->getOpeningTimes())) {
                        foreach ($one_day->getOpeningTimes() as $opening_time) {
                            $output .= '<span class="cf-from cf-meta">van</span>';
                            $output .=  substr($opening_time->getOpenFrom(), 0, -3);
                            if (!is_null($opening_time->getOpenTill())) {
                                $output .= '<span class="cf-to cf-meta">tot</span>' .
                                    substr($opening_time->getOpenTill(), 0, -3);
                            }
                        }
                    }
                    $output .= '</meta>';
                    $output .= '</li>';
                }
            }
        }
        $output .= '</ul>';

        // This generates a localised string of a weekday, still figuring how to get it in the previous code
        $fmt_day = new IntlDateFormatter(
            'nl_BE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            'eeee'
        );

        return $output;
    }
}
