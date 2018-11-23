<?php

declare(strict_types=1);

namespace App\Resource\SimpleCms;

use App\Model\SimpleCms\Content;
use App\Resource\AbstractResource;
use GuzzleHttp\ClientInterface;

final class ContentResource extends AbstractResource
{
    public function __construct(ClientInterface $client)
    {
        parent::__construct($client, '/contents', Content::class, Content::getClassProperties());
    }
}
