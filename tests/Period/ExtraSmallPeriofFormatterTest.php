<?php
/**
 * @file
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;

class ExtraSmallPeriofFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExtraSmallPeriodFormatter
     */
    protected $formatter;

    public function setUp() {
        $this->formatter = new ExtraSmallPeriodFormatter();
    }

    public function testFormatsAPeriod()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-20',
            '2015-03-27'
        );

        $this->assertEquals(
            '<span class="date">20</span>/<span class="month">03</span>',
            $this->formatter->format($period)
        );
    }
}
