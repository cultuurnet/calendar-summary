<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 26-3-15
 * Time: 10:28
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use \CultureFeed_Cdb_Data_Calendar_Timestamp;

class LargeTimestampsFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargeTimestampsFormatter
     */
    protected $formatter;


    public function setUp()
    {
        $this->formatter = new \CultuurNet\CalendarSummary\Timestamps\LargeTimestampsFormatter();
    }

    public function testFormatsAsTimestamps()
    {
//        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
//        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2015-09-20', '09:00:00', '12:30:00');
//        $timestamp_list->add($timestamp);
//
//        $this->assertEquals(
//            '<span class="cf-date">20</span>/<span class="cf-month">11</span>',
//            $this->formatter->format($timestamp_list)
//        );
    }

    public function testFormatsAsTimestampsDayWithoutLeadingZero()
    {

    }
}
