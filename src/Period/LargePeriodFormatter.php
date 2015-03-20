<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 14:15
 */

namespace CultuurNet\CalendarSummary\Period;

class LargePeriodFormatter implements PeriodFomatterInterface
{

    public function format(
        \CultureFeed_Cdb_Data_Calendar_Period $period
    ) {
        $dateFrom = $period->getDateFrom();
        $dateTo = $period->getDateTo();

        $dateFromLarge = date('DD m YY', strtotime($dateFrom));
        $dateToLarge = date('DD m YY', strtotime($dateTo));

        $output = '<p>';
        $output .= '<time itemprop="startDate" datetime="' . $dateFrom . '">';
        $output .= '<span class="cf-date">' . $dateFromLarge . '</span>';
        $output .= '<span class="to meta">tot</span>';
        $output .= '<time itemprop="endDate" datetime="' . $dateTo . '">';
        $output .= '<span class="cf-date">' . $dateToLarge . '</span>';
        $output .= '</p>';

        $output .= '<p>Openingsuren:</p>';
        $output .= '<ul class="list-unstyled">';


        /*$weekscheme = $period->getWeekScheme();

        // Repeat this for every openingtime.
        $output .= '<li>';
        $output .= '<meta itemprop="openingHours" content="' .  . '">';
        $output .= '<span class="cf-days">' . . '</span>';
        $output .= '<span class="from meta">van</span>' . ;
        $output .= '<span class="to meta">tot</span>' . ;
        $output .= '</meta>';
        $output .= '</li>';*/

        return $output;
    }
}
