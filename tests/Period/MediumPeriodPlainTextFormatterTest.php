<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-3-15
 * Time: 15:58
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;

class MediumPeriodPlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MediumPeriodPlainTextFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new MediumPeriodPlainTextFormatter();
    }

    public function testFormatsAPeriod()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-20',
            '2015-03-27'
        );

        $this->assertEquals(
            'Van 20 maart 2015 tot 27 maart 2015',
            $this->formatter->format($period)
        );
    }

    public function testFormatsAPeriodDayWithoutLeadingZero()
    {
        $period = new CultureFeed_Cdb_Data_Calendar_Period(
            '2015-03-01',
            '2015-03-05'
        );

        $this->assertEquals(
            'Van 1 maart 2015 tot 5 maart 2015',
            $this->formatter->format($period)
        );
    }
}
