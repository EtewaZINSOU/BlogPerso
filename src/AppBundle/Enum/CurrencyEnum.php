<?php

namespace AppBundle\Enum;

/**
 * Class CurrencyEnum.
 */
class CurrencyEnum extends AbstractEnum
{
    const EUR = 'eur';
    const USD = 'usd';

    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return [self::EUR, self::USD];
    }
}
