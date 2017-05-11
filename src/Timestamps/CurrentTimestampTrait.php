<?php

namespace CultuurNet\CalendarSummary\Timestamps;

trait CurrentTimestampTrait
{
    /**
     * @var int
     */
    private $currentTimestamp;

    /**
     * Make it possible to set the current time.
     * Added for making the unit tests independent of the real time.
     *
     * @param int $currentTimestamp
     */
    public function setCurrentTimestamp($currentTimestamp)
    {
        if (!is_int($currentTimestamp)) {
            throw new \InvalidArgumentException(
                'The timestamp for the current time needs to be of type int.'
            );
        }

        $this->currentTimestamp = $currentTimestamp;
    }

    /**
     * @return int
     */
    public function getCurrentTimestamp()
    {
        if ($this->currentTimestamp) {
            return $this->currentTimestamp;
        } else {
            return strtotime(date('Y-m-d') . ' 00:00:00');
        }
    }
}
