<?php

declare(strict_types=1);

namespace App\Model\SimpleCms;

use App\Model\ReflectionClassTrait;

final class Content
{
    use ReflectionCltassTrait;

    /** @var string */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $text;
    /** @var \DateTime */
    public $createdAt;
    /** @var \DateTime */
    public $updatedAt;
}
