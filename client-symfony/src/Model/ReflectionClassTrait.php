<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

trait ReflectionClassTrait
{
    public static function getClassProperties(): array
    {
        return (new PropertyInfoExtractor([new ReflectionExtractor()]))->getProperties(__CLASS__);
    }
}
