<?php

namespace CultuurNet\CalendarSummary\Timestamps;

class CurrentTimestampTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurrentTimestampTrait|\PHPUnit_Framework_MockObject_MockObject
     */
    private $currentTimestampTrait;

    protected function setUp()
    {
        $this->currentTimestampTrait = $this->getMockForTrait(
            CurrentTimestampTrait::class
        );
    }

    public function testItCanSetACurrentTimestamp()
    {
        $expectedTimestamp = strtotime('now');

        $this->currentTimestampTrait->setCurrentTimestamp($expectedTimestamp);

        $this->assertEquals(
            $expectedTimestamp,
            $this->currentTimestampTrait->getCurrentTimestamp()
        );
    }

    public function testItHasADefaultTimestampOfTodayMidnight()
    {
        // Theoretically this could fail when run at midnight.
        $expectedTimestamp = strtotime(date('Y-m-d') . ' 00:00:00');

        $timestamp = $this->currentTimestampTrait->getCurrentTimestamp();

        $this->assertEquals(
            $expectedTimestamp,
            $timestamp
        );
    }

    public function testItRequiresAnIntegerTimestamp()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The timestamp for the current time needs to be of type int.'
        );

        $this->currentTimestampTrait->setCurrentTimestamp('now');
    }
}
