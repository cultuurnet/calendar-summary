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

class LargePermanentPlainTextFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargePermanentPlainTextFormatter
     */
    protected $formatter;

    public function setUp()
    {
        $this->formatter = new LargePermanentPlainTextFormatter();
    }

    public function testFormatsAsSimplePermanent()
    {

    }

    public function testFormatsAsMixedPermanent()
    {

    }
}
