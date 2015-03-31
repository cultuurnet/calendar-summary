<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 20/03/15
 * Time: 11:04
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;

class SmallPeriodHTMLFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmallPeriodHTMLFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new SmallPeriodHTMLFormatter();
    }

    public function testFormatsAPeriod()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2020-03-20',
            '2025-03-27'
        );

        $this->assertEquals(
            '<span class="from meta">Vanaf</span> <span class="cf-date">20</span> <span class="cf-month">mrt</span>',
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
            '<span class="from meta">Vanaf</span> <span class="cf-date">1</span> <span class="cf-month">mrt</span>',
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
            '<span class="to meta">Tot</span> <span class="cf-date">25</span> <span class="cf-month">mrt</span>',
            $this->formatter->format($period)
        );
    }
}
