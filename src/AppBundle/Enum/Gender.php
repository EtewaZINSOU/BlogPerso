<?php

namespace AppBundle\Enum;

/**
 * Class Gender.
 */
class Gender
{
    const MALE = 1;
    const FEMALE = 2;
    const UNKNOWN = 3;

    /**
     * @return array
     */
    public static function getChoices()
    {
        return [
            'male' => self::MALE,
            'female' => self::FEMALE,
            'unknown' => self::UNKNOWN,
        ];
    }
}
