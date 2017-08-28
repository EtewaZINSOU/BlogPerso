<?php

namespace AppBundle\Enum;


/**
 * Class BillingTypeEnum.
 */
class BillingTypeEnum extends AbstractEnum
{
    const DAILY_RATE = 'daily_rate';
    const FLAT_FEE = 'flat_fee';
    const HOURLY_RATE = 'hourly_rate';

    /**
     * {@inheritdoc}
     */
    public static function getChoices(): array
    {
        return [
            self::DAILY_RATE,
            self::FLAT_FEE,
            self::HOURLY_RATE,
        ];
    }
}
