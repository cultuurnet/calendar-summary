<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 26-3-15
 * Time: 10:28
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use \CultureFeed_Cdb_Data_Calendar_TimestampList;
use \CultureFeed_Cdb_Data_Calendar_Timestamp;

class MediumTimestampsHTMLFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MediumTimestampsHTMLFormatter
     */
    protected $formatter;


    public function setUp()
    {
        $this->formatter = new MediumTimestampsHTMLFormatter();
    }

    public function testFormatsASingleTimestamp()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp_list->add($timestamp);

        $output = '<span class="cf-weekday cf-meta">zondag</span>';
        $output .= '<span class="cf-date">20 september 2020</span>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsASingleTimestampWithoutLeadingZero()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-09', '09:00:00');
        $timestamp_list->add($timestamp);

        $output = '<span class="cf-weekday cf-meta">woensdag</span>';
        $output .= '<span class="cf-date">9 september 2020</span>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestamps()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-21', '09:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-22', '09:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<span class="cf-from cf-meta">Van</span>';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= '<span class="cf-date">22 september 2020</span>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithoutLeadingZero()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-07', '09:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-08', '09:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-09', '09:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<span class="cf-from cf-meta">Van</span>';
        $output .= '<span class="cf-date">7 september 2020</span>';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= '<span class="cf-date">9 september 2020</span>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }
}
