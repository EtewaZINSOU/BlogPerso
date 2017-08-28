<?php


namespace AppBundle\Enum;


/**
* Class AbstractEnum
 */
abstract class AbstractEnum
{
    /**
     * @return array
     */
    abstract public static function getChoices(): array;

    /**
     * @return array
     */
    public static function getChoicesWithLabels(): array
    {
        $className = (new \ReflectionClass(static::class))->getShortName();

        return array_combine(
            array_map(
                function ($value) use ($className) {
                    return sprintf('enum.%s.%s', $className, $value);
                },
                static::getChoices()
            ),
            static::getChoices()
        );
    }
}
