<?php

namespace AppBundle\Enum;

/**
 * Class AssetStatusEnum.
 */
class AssetStatusEnum extends AbstractEnum
{
    const PENDING = 'pending';
    const VALIDATED = 'validated';
    const CANCELLED = 'cancelled';

    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return [self::PENDING, self::VALIDATED, self::CANCELLED];
    }
}
