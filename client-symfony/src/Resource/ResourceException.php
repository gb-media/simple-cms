<?php

declare(strict_types=1);

namespace App\Resource;

class ResourceException extends \Exception
{
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct("[RESOURCES] $message", $code);
    }
}
