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

    public function __construct($locale = 'nl_BE')
    {
        $this->mapping = [
            \CultureFeed_Cdb_Data_Calendar_TimestampList::class =>
            [
                'lg' => new LargeTimestampsPlainTextFormatter($locale),
                'md' => new MediumTimestampsPlainTextFormatter($locale),
                'sm' => new SmallTimestampsPlainTextFormatter($locale),
                'xs' => new ExtraSmallTimestampsPlainTextFormatter($locale),
            ],
            \CultureFeed_Cdb_Data_Calendar_PeriodList::class =>
            [
                'lg' => new LargePeriodPlainTextFormatter($locale),
                'md' => new MediumPeriodPlainTextFormatter($locale),
                'sm' => new SmallPeriodPlainTextFormatter($locale),
                'xs' => new ExtraSmallPeriodPlainTextFormatter($locale),
            ],
            \CultureFeed_Cdb_Data_Calendar_Permanent::class =>
            [
                'lg' => new LargePermanentPlainTextFormatter($locale),
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
