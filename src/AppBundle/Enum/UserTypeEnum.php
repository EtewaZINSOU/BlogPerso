<?php

namespace AppBundle\Enum;

/**
 * Class UserTypeEnum.
 */
class UserTypeEnum extends AbstractEnum
{
    const ADMINISTRATOR = 'administrator';
    const ASSOCIATE = 'associate';
    const COLLABORATER = 'collaborater';
    const TRAINEE = 'trainee';

    /**
     * {@inheritdoc}
     */
    public static function getChoices(): array
    {
        return [
            self::ADMINISTRATOR,
            self::ASSOCIATE,
            self::COLLABORATER,
            self::TRAINEE,
        ];
    }
}
