<?php

declare(strict_types=1);

namespace App\Resource;

interface Resource
{
    public function delete(string $uuid): bool;

    public function getCollection(array $filters = []): array;

    public function getItem(string $uuid): object;

    public function post(object $object): object;

    public function put(string $uuid, array $data = []): object;
}
