<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 11:01
 */

namespace CultuurNet\CalendarSummary;

use CultuurNet\CalendarSummary\Period\ExtraSmallPeriodHTMLFormatter;
use CultuurNet\CalendarSummary\Period\LargePeriodHTMLFormatter;
use CultuurNet\CalendarSummary\Period\MediumPeriodHTMLFormatter;
use CultuurNet\CalendarSummary\Period\SmallPeriodHTMLFormatter;
use CultuurNet\CalendarSummary\Permanent\LargePermanentHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\ExtraSmallTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\LargeTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\MediumTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\SmallTimestampsHTMLFormatter;

class CalendarHTMLFormatter implements CalendarFormatterInterface
{
    protected $mapping = array();

    public function __construct($locale = 'nl_BE')
    {
        $this->mapping = [
            \CultureFeed_Cdb_Data_Calendar_TimestampList::class =>
            [
                'lg' => new LargeTimestampsHTMLFormatter($locale),
                'md' => new MediumTimestampsHTMLFormatter($locale),
                'sm' => new SmallTimestampsHTMLFormatter($locale),
                'xs' => new ExtraSmallTimestampsHTMLFormatter($locale),
            ],
            \CultureFeed_Cdb_Data_Calendar_PeriodList::class =>
            [
                'lg' => new LargePeriodHTMLFormatter($locale),
                'md' => new MediumPeriodHTMLFormatter($locale),
                'sm' => new SmallPeriodHTMLFormatter($locale),
                'xs' => new ExtraSmallPeriodHTMLFormatter($locale),
            ],
            \CultureFeed_Cdb_Data_Calendar_Permanent::class =>
            [
                'lg' => new LargePermanentHTMLFormatter(),
            ],
        ];
    }

    public function format(\CultureFeed_Cdb_Data_Calendar $calendar, $format)
    {
        $class = get_class($calendar);

        if (isset($this->mapping[$class][$format])) {
            $formatter = $this->mapping[$class][$format];
        } else {
            throw new FormatterException($format . ' format not supported for ' . $class);
        }

        return $formatter->format($calendar);
    }
}
