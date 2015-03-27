<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 11:01
 */

namespace CultuurNet\CalendarSummary;

use CultuurNet\CalendarSummary\Period\ExtraSmallPeriodFormatter;
use CultuurNet\CalendarSummary\Period\LargePeriodFormatter;
use CultuurNet\CalendarSummary\Period\MediumPeriodFormatter;
use CultuurNet\CalendarSummary\Period\SmallPeriodFormatter;
use CultuurNet\CalendarSummary\Permanent\LargePermanentFormatter;
use CultuurNet\CalendarSummary\Timestamps\ExtraSmallTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\LargeTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\MediumTimestampsHTMLFormatter;
use CultuurNet\CalendarSummary\Timestamps\SmallTimestampsHTMLFormatter;

class CalendarHTMLFormatter implements CalendarFormatterInterface
{
    protected $mapping = array();

    public function __construct()
    {
        $this->mapping = [
            \CultureFeed_Cdb_Data_Calendar_TimestampList::class =>
            [
                'lg' => new LargeTimestampsHTMLFormatter(),
                'md' => new MediumTimestampsHTMLFormatter(),
                'sm' => new SmallTimestampsHTMLFormatter(),
                'xs' => new ExtraSmallTimestampsHTMLFormatter(),
            ],
            \CultureFeed_Cdb_Data_Calendar_Period::class =>
            [
                'lg' => new LargePeriodFormatter(),
                'md' => new MediumPeriodFormatter(),
                'sm' => new SmallPeriodFormatter(),
                'xs' => new ExtraSmallPeriodFormatter(),
            ],
            \CultureFeed_Cdb_Data_Calendar_Permanent::class =>
            [
                'lg' => new LargePermanentFormatter(),
            ],
        ];
    }

    public function format(\CultureFeed_Cdb_Data_Calendar $calendar, $format)
    {
        // TODO: Implement format() method.
        // Check which kind of Calendar we get in (Calendar is abstract class).
        // Then use the mapping to do the correct formatting.

        $class = get_class($calendar);
        $formatter = $this->mapping[$class][$format];
        return $formatter->format($calendar);
    }
}
