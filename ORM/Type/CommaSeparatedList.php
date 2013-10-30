<?php

namespace Namshi\UtilityBundle\ORM\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class CommaSeparatedList represents an array of values that will be persisted as a string of comma-separated strings.
 *
 * @see http://dev.mysql.com/doc/refman/5.0/en/string-functions.html#function_find-in-set
 * @package Namshi\UtilityBundle\ORM\Type
 */
class CommaSeparatedList extends Type
{
    /**
     * Name of this type
     */
    const NAME = 'comma_separated_list'; // modify to match your type name

    /**
     * @inheritDoc
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL(array());
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return explode(',', $value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return implode(',', $value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::NAME;
    }
} 