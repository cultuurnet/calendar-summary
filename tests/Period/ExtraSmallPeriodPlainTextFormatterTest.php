<?php
/**
 * @file
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;
use \CultureFeed_Cdb_Data_Calendar_PeriodList;

class ExtraSmallPeriodPlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExtraSmallPeriodPlainTextFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new ExtraSmallPeriodPlainTextFormatter();
    }

    public function testFormatsAPeriod()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-20',
            '2015-03-27'
        );
        $periodList = new CultureFeed_Cdb_Data_Calendar_PeriodList();
        $periodList->add($period);

        $this->assertEquals(
            '20/03',
            $this->formatter->format($periodList)
        );
    }

    public function testFormatsAPeriodDayWithoutLeadingZero()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-01',
            '2015-03-05'
        );
        $periodList = new CultureFeed_Cdb_Data_Calendar_PeriodList();
        $periodList->add($period);

        $this->assertEquals(
            '1/03',
            $this->formatter->format($periodList)
        );
    }
}
