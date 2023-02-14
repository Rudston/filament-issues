<?php

namespace App\Utilities;


class DateTimeUtilities {

    public static function doTimestampIntervalsOverlap($from1, $to1, $from2, $to2): bool
    {
        return ($to2 === null || $from1 < $to2) && ($to1 === null || $to1 > $from2);
    }

    /**
     * The array $multipleFromToRanges contains arrays like [from => ..., to => ...]
     *
     * @param array $multipleFromToRanges
     * @param int $initialIndex
     * @return bool true if there is at least one overlap
     */
    public static function findAnyOverlap(array $multipleFromToRanges, int $initialIndex = 0): bool {
        $firstFromTo = $multipleFromToRanges[$initialIndex];
        $overlap = false;
        foreach ($multipleFromToRanges as $index => $fromToArray) {
            if ($index > $initialIndex) {
                if (self::doTimestampIntervalsOverlap($firstFromTo['from'], $firstFromTo['to'],
                    $fromToArray['from'], $fromToArray['to'])) {
                    $overlap = true;
                    break;
                }
            }
        }
        if ($overlap) {
            return true;
        } else {
            $initialIndex++;
            if (count($multipleFromToRanges) > $initialIndex + 1) {
                return self::findAnyOverlap($multipleFromToRanges, $initialIndex);
            } else {
                return false;
            }
        }
    }
}


