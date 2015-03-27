<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 26-3-15
 * Time: 10:27
 */

namespace CultuurNet\CalendarSummary\Permanent;

use \CultureFeed_Cdb_Data_Calendar_Permanent;
use \CultureFeed_Cdb_Data_Calendar_SchemeDay as SchemeDay;

class LargePermanentFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargePermanentFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new LargePermanentFormatter();
    }

    public function testFormatsAsPermanent()
    {
        $permanent = new CultureFeed_Cdb_Data_Calendar_Permanent();

        $weekscheme=new \CultureFeed_Cdb_Data_Calendar_Weekscheme();

        $monday=new \CultureFeed_Cdb_Data_Calendar_SchemeDay(SchemeDay::MONDAY, SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN);
        $ot1 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('09:00:00', '13:00:00');
        $ot2 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('17:00:00', '20:00:00');
        $monday->addOpeningTime($ot1);
        $monday->addOpeningTime($ot2);

        $tuesday=new \CultureFeed_Cdb_Data_Calendar_SchemeDay(SchemeDay::TUESDAY, SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN);
        $ot3 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('09:00:00', '13:00:00');
        $ot4= new \CultureFeed_Cdb_Data_Calendar_OpeningTime('17:00:00', '20:00:00');
        $tuesday->addOpeningTime($ot3);
        $tuesday->addOpeningTime($ot4);

        $wednesday = new \CultureFeed_Cdb_Data_Calendar_SchemeDay(
            SchemeDay::WEDNESDAY,
            SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN
        );
        $ot5 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('09:00:00', '17:00:00');
        $wednesday->addOpeningTime($ot5);

        $friday = new \CultureFeed_Cdb_Data_Calendar_SchemeDay(SchemeDay::FRIDAY, SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN);
        $ot6 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('09:00:00', '13:00:00');
        $ot7 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('17:00:00', '20:00:00');
        $friday->addOpeningTime($ot6);
        $friday->addOpeningTime($ot7);

        $saturday = new \CultureFeed_Cdb_Data_Calendar_SchemeDay(
            SchemeDay::SATURDAY,
            SchemeDay::SCHEMEDAY_OPEN_TYPE_OPEN
        );
        $ot8 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('09:00:00', '13:00:00');
        $ot9 = new \CultureFeed_Cdb_Data_Calendar_OpeningTime('17:00:00', '20:00:00');
        $saturday->addOpeningTime($ot8);
        $saturday->addOpeningTime($ot9);

        $weekscheme->setDay(SchemeDay::MONDAY, $monday);
        $weekscheme->setDay(SchemeDay::TUESDAY, $tuesday);
        $weekscheme->setDay(SchemeDay::WEDNESDAY, $wednesday);
        $weekscheme->setDay(SchemeDay::FRIDAY, $friday);
        $weekscheme->setDay(SchemeDay::SATURDAY, $saturday);


        $permanent->setWeekScheme($weekscheme);

        $this->assertEquals(
            '<ul class="list-unstyled"><meta itemprop="openingHours" datetime="Mo-Tu 9:00-20:00"></meta>'
            . '<li itemprop="openingHoursSpecification"><span class="cf-days">Maandag - dinsdag</span>'
            . '<span itemprop="opens" content="9:00" class="cf-from cf-meta">van</span>9:00'
            . '<span itemprop="closes" content="13:00" class="cf-to cf-meta">tot</span>13:00'
            . '<span itemprop="opens" content="17:00" class="cf-from cf-meta">van</span>17:00'
            . '<span itemprop="closes" content="20:00" class="cf-to cf-meta">tot</span>20:00</li>'
            . '<meta itemprop="openingHours" datetime="We 9:00-17:00"></meta><li itemprop="openingHoursSpecification">'
            . '<span class="cf-days">Woensdag</span>'
            . '<span itemprop="opens" content="9:00" class="cf-from cf-meta">van</span>9:00'
            . '<span itemprop="closes" content="17:00" class="cf-to cf-meta">tot</span>17:00</li>'
            . '<meta itemprop="openingHours" datetime="Fr-Sa 9:00-20:00"></meta>'
            . '<li itemprop="openingHoursSpecification"><span class="cf-days">Vrijdag - zaterdag</span>'
            . '<span itemprop="opens" content="9:00" class="cf-from cf-meta">van</span>9:00'
            . '<span itemprop="closes" content="13:00" class="cf-to cf-meta">tot</span>13:00'
            . '<span itemprop="opens" content="17:00" class="cf-from cf-meta">van</span>17:00'
            . '<span itemprop="closes" content="20:00" class="cf-to cf-meta">tot</span>20:00</li></ul>',
            $this->formatter->format($permanent)
        );
    }
}