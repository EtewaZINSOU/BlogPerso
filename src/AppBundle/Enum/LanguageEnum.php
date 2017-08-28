<?php

namespace AppBundle\Enum;


/**
 * Class LanguageEnum.
 */
class LanguageEnum extends AbstractEnum
{
    const FRENCH = 'fr';
    const ENGLISH = 'en';
    const RUSSIAN = 'ru';
    const PORTUGUESE = 'pt';
    const SPANISH = 'es';
    const PORTUGUESE_ELFINDER = 'pt_BR';

    const LANGUAGES = [
        self::FRENCH,
        self::ENGLISH,
        self::RUSSIAN,
        self::PORTUGUESE,
        self::SPANISH,
    ];


    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return self::LANGUAGES;
    }
}
