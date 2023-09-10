<?php

declare(strict_types=1);

namespace App\Enums;

enum Direction: string
{
    case North = 'N';
    case NorthEast = 'NE';
    case East = 'E';
    case SouthEast = 'SE';
    case South = 'S';
    case SouthWest = 'SW';
    case West = 'W';
    case NorthSouth = 'NW';

    /**
     * Convert Degrees to Direction using 8 Point Compass Implementation
     * - Cardinal Directions: N, E, S, W
     * - Ordinal Directions: NE, SE, SW, NW
     */
    public static function convertFromDegrees(int $degrees = 0): string
    {
        if ($degrees < 0) {
            // Handle negative input value
            $degrees *= -1;
        }

        $index = \floor(($degrees / 45)) % 8;

        return self::cases()[$index]->value;
    }
}
