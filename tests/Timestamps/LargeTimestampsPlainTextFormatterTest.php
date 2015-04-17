<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 27/03/15
 * Time: 17:46
 */

namespace CultuurNet\CalendarSummary\Timestamps;

use \CultureFeed_Cdb_Data_Calendar_TimestampList;
use \CultureFeed_Cdb_Data_Calendar_Timestamp;

class LargeTimestampsPlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargeTimestampsFormatter
     */
    protected $formatter;


    public function setUp()
    {
        $this->formatter = new LargeTimestampsPlainTextFormatter();
    }

    public function testFormatsATimestampWithStartTime()
    {
        $timestamp_list = new CultureFeed_Cdb_Data_Calendar_TimestampList();
        $timestamp = new CultureFeed_Cdb_Data_Calendar_Timestamp('2020-09-20', '09:00:00');
        $timestamp_list->add($timestamp);

        $output = 'zondag 20 september 2020' . PHP_EOL;
        $output .= 'om 09:00';

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

        $output = 'woensdag 9 september 2020' . PHP_EOL;
        $output .= 'om 09:00';

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

        $output = 'zondag 20 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 12:30';

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

        $output = 'zo 20 september 2020' . PHP_EOL;
        $output .= 'om 09:00' . PHP_EOL;
        $output .= 'ma 21 september 2020' . PHP_EOL;
        $output .= 'om 10:00' . PHP_EOL;
        $output .= 'di 22 september 2020' . PHP_EOL;
        $output .= 'om 09:00';

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

        $output = 'zo 20 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 17:00' . PHP_EOL;
        $output .= 'ma 21 september 2020' . PHP_EOL;
        $output .= 'van 10:00 tot 18:00' . PHP_EOL;
        $output .= 'di 22 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 17:00';

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

        $output = 'zo 20 september 2020' . PHP_EOL;
        $output .= 'om 09:00' . PHP_EOL;
        $output .= 'ma 21 september 2020' . PHP_EOL;
        $output .= 'van 10:00 tot 18:00' . PHP_EOL;
        $output .= 'di 22 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 17:00';

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

        $output = 'ma 7 september 2020' . PHP_EOL;
        $output .= 'om 09:00' . PHP_EOL;
        $output .= 'di 8 september 2020' . PHP_EOL;
        $output .= 'van 10:00 tot 18:00' . PHP_EOL;
        $output .= 'wo 9 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 17:00';

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

        $output = 'ma 21 september 2020' . PHP_EOL;
        $output .= 'van 10:00 tot 18:00' . PHP_EOL;
        $output .= 'di 22 september 2020' . PHP_EOL;
        $output .= 'van 09:00 tot 17:00';

        $this->assertEquals(
            $output,
            $this->formatter->format($timestamp_list)
        );
    }
}
