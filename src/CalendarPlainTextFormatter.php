<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/03/15
 * Time: 11:01
 */

namespace CultuurNet\CalendarSummary;

use CultuurNet\CalendarSummary\Period\ExtraSmallPeriodPlainTextFormatter;
use CultuurNet\CalendarSummary\Period\LargePeriodPlainTextFormatter;
use CultuurNet\CalendarSummary\Period\MediumPeriodPlainTextFormatter;
use CultuurNet\CalendarSummary\Period\SmallPeriodPlainTextFormatter;
use CultuurNet\CalendarSummary\Permanent\LargePermanentPlainTextFormatter;
use CultuurNet\CalendarSummary\Timestamps\ExtraSmallTimestampsPlainTextFormatter;
use CultuurNet\CalendarSummary\Timestamps\LargeTimestampsPlainTextFormatter;
use CultuurNet\CalendarSummary\Timestamps\MediumTimestampsPlainTextFormatter;
use CultuurNet\CalendarSummary\Timestamps\SmallTimestampsPlainTextFormatter;

class CalendarPlainTextFormatter implements CalendarFormatterInterface
{
    protected $mapping = array();

    public function __construct()
    {
        $this->mapping = [
            \CultureFeed_Cdb_Data_Calendar_TimestampList::class =>
            [
                'lg' => new LargeTimestampsPlainTextFormatter(),
                'md' => new MediumTimestampsPlainTextFormatter(),
                'sm' => new SmallTimestampsPlainTextFormatter(),
                'xs' => new ExtraSmallTimestampsPlainTextFormatter(),
            ],
            \CultureFeed_Cdb_Data_Calendar_Period::class =>
            [
                'lg' => new LargePeriodPlainTextFormatter(),
                'md' => new MediumPeriodPlainTextFormatter(),
                'sm' => new SmallPeriodPlainTextFormatter(),
                'xs' => new ExtraSmallPeriodPlainTextFormatter(),
            ],
            \CultureFeed_Cdb_Data_Calendar_Permanent::class =>
            [
                'lg' => new LargePermanentPlainTextFormatter(),
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
