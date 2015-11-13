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

class LargeTimestampsHTMLFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargeTimestampsHTMLFormatter
     */
    protected $formatter;


    public function setUp()
    {
        $this->formatter = new LargeTimestampsHTMLFormatter();
    }

    public function testFormatsATimestampWithStartTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp_list->add($timestamp);

        $output = '<time itemprop="startDate" datetime="2020-09-20T09:00">';
        $output .= '<span class="cf-weekday cf-meta">zondag</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsATimestampWithStartTimeWithoutLeadingZero()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-09', '09:00:00');
        $timestamp_list->add($timestamp);

        $output = '<time itemprop="startDate" datetime="2020-09-09T09:00">';
        $output .= '<span class="cf-weekday cf-meta">woensdag</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">9 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsATimestampWithStartTimeAndEndTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00', '12:30:00');
        $timestamp_list->add($timestamp);

        $output = '<time itemprop="startDate" datetime="2020-09-20T09:00">';
        $output .= '<span class="cf-weekday cf-meta">zondag</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-20T12:30">';
        $output .= '<span class="cf-time">12:30</span>';
        $output .= '</time>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithStartTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-21', '10:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-22', '09:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-20T09:00">';
        $output .= '<span class="cf-weekday cf-meta">zo</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-21T10:00">';
        $output .= '<span class="cf-weekday cf-meta">ma</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">21 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">10:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-22T09:00">';
        $output .= '<span class="cf-weekday cf-meta">di</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">22 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '</ul>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsASingleTimestampBeginningOfYear()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2016-01-03', '19:00:00', '23:00:00');
        $timestamp_list->add($timestamp);

        $output = '<time itemprop="startDate" datetime="2016-01-03T19:00">';
        $output .= '<span class="cf-weekday cf-meta">zondag</span> ';
        $output .= '<span class="cf-date">3 januari 2016</span> ';
        $output .= '<span class="cf-from cf-meta">van</span> ';
        $output .= '<span class="cf-time">19:00</span></time> ';
        $output .= '<span class="cf-to cf-meta">tot</span> ';
        $output .= '<time itemprop="endDate" datetime="2016-01-03T23:00">';
        $output .= '<span class="cf-time">23:00</span></time>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithStartTimeAndEndTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00', '17:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-21', '10:00:00', '18:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-22', '09:00:00', '17:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-20T09:00">';
        $output .= '<span class="cf-weekday cf-meta">zo</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-20T17:00">';
        $output .= '<span class="cf-time">17:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-21T10:00">';
        $output .= '<span class="cf-weekday cf-meta">ma</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">21 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">10:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-21T18:00">';
        $output .= '<span class="cf-time">18:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-22T09:00">';
        $output .= '<span class="cf-weekday cf-meta">di</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">22 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-22T17:00">';
        $output .= '<span class="cf-time">17:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '</ul>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithStartTimeOrStartTimeAndEndTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-21', '10:00:00', '18:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-22', '09:00:00', '17:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-20T09:00">';
        $output .= '<span class="cf-weekday cf-meta">zo</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-21T10:00">';
        $output .= '<span class="cf-weekday cf-meta">ma</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">21 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">10:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-21T18:00">';
        $output .= '<span class="cf-time">18:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-22T09:00">';
        $output .= '<span class="cf-weekday cf-meta">di</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">22 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-22T17:00">';
        $output .= '<span class="cf-time">17:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '</ul>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithStartTimeOrStartTimeAndEndTimeWithoutLeadingZero()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-07', '09:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-08', '10:00:00', '18:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-09', '09:00:00', '17:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-07T09:00">';
        $output .= '<span class="cf-weekday cf-meta">ma</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">7 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">om</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-08T10:00">';
        $output .= '<span class="cf-weekday cf-meta">di</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">8 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">10:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-08T18:00">';
        $output .= '<span class="cf-time">18:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-09T09:00">';
        $output .= '<span class="cf-weekday cf-meta">wo</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">9 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-09T17:00">';
        $output .= '<span class="cf-time">17:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '</ul>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsMultipleTimestampsWithPastAndFutureTimestamps()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp1 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2015-03-26', '09:00:00', '17:00:00');
        $timestamp2 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-21', '10:00:00', '18:00:00');
        $timestamp3 = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-22', '09:00:00', '17:00:00');
        $timestamp_list->add($timestamp1);
        $timestamp_list->add($timestamp2);
        $timestamp_list->add($timestamp3);

        $output = '<ul class="list-unstyled">';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-21T10:00">';
        $output .= '<span class="cf-weekday cf-meta">ma</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">21 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">10:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-21T18:00">';
        $output .= '<span class="cf-time">18:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '<li>';
        $output .= '<time itemprop="startDate" datetime="2020-09-22T09:00">';
        $output .= '<span class="cf-weekday cf-meta">di</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">22 september 2020</span>';
        $output .= ' ';
        $output .= '<span class="cf-from cf-meta">van</span>';
        $output .= ' ';
        $output .= '<span class="cf-time">09:00</span>';
        $output .= '</time>';
        $output .= ' ';
        $output .= '<span class="cf-to cf-meta">tot</span>';
        $output .= ' ';
        $output .= '<time itemprop="endDate" datetime="2020-09-22T17:00">';
        $output .= '<span class="cf-time">17:00</span>';
        $output .= '</time>';
        $output .= '</li>';
        $output .= '</ul>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }

    public function testFormatsATimestampWithoutTimes()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20');
        $timestamp_list->add($timestamp);

        $output = '<time itemprop="startDate" datetime="2020-09-20">';
        $output .= '<span class="cf-weekday cf-meta">zondag</span>';
        $output .= ' ';
        $output .= '<span class="cf-date">20 september 2020</span>';
        $output .= ' ';
        $output .= '</time>';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }
}
