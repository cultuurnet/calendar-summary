<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 24-3-15
 * Time: 14:52
 */

namespace CultuurNet\CalendarSummary\Period;

use \CultureFeed_Cdb_Data_Calendar_Period;
use \CultureFeed_Cdb_Data_Calendar_SchemeDay as SchemeDay;

class LargePeriodFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargePeriodFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new LargePeriodFormatter();
    }

    public function testFormatsAPeriod()
    {

    }
}
