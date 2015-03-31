<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 20/03/15
 * Time: 11:04
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;

class SmallPeriodPlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmallPeriodPlainTextFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new SmallPeriodPlainTextFormatter();
    }

    public function testFormatsAPeriod()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2020-03-20',
            '2025-03-27'
        );

        $this->assertEquals(
            'Vanaf 20 mrt',
            $this->formatter->format($period)
        );
    }

    public function testFormatsAPeriodDayWithoutLeadingZero()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2020-03-01',
            '2025-03-05'
        );

        $this->assertEquals(
            'Vanaf 1 mrt',
            $this->formatter->format($period)
        );
    }

    public function testFormatsAPeriodThatHasAlreadyStarted()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-19',
            '2020-03-25'
        );

        $this->assertEquals(
            'Tot 25 mrt',
            $this->formatter->format($period)
        );
    }
}
