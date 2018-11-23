<?php

declare(strict_types=1);

namespace App\Resource;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class AbstractResource implements Resource
{
    /** @var array|null */
    private $attributes;
    /** @var string|null */
    private $class;
    /** @var ClientInterface */
    private $client;
    /** @var string */
    private $entrypoint;
    /** @var ObjectNormalizer */
    private $objectNormalizer;

    public function __construct(ClientInterface $client, string $entrypoint, ?string $class, ?array $attributes)
    {
        $this->attributes = $attributes;
        $this->class = $class;
        $this->client = $client;
        $this->entrypoint = $entrypoint;
        $this->objectNormalizer = new ObjectNormalizer();
    }

    /**
     * @throws ResourceException
     */
    public function delete(string $uuid): bool
    {
        // @todo: validator UUID and webmozart/assert
        if (!$uuid || !\is_string($uuid)) {
            $this->throwException('Uuid is required.');
        }
        try {
            $request = $this->client->request(Request::METHOD_DELETE, "$this->entrypoint/$uuid");

            return Response::HTTP_NO_CONTENT === $request->getStatusCode();
        } catch (ClientException $e) {
            $this->throwException("Failed to delete \"$this->entrypoint/$uuid\" SimpleCMS resource.");
        }
    }

    /**
     * @throws ResourceException
     */
    public function getCollection(array $filters = []): array
    {
        try {
            return $this->deserialize(
                $this->client->request(Request::METHOD_GET, $this->entrypoint)->getBody()->getContents()
            );
        } catch (ClientException $e) {
            $this->throwException("Failed to get \"$this->entrypoint\" SimpleCMS resource.");
        }
    }

    /**
     * @throws ResourceException
     */
    public function getItem(string $uuid): object
    {
        // @todo: validator UUID and webmozart/assert
        if (!$uuid || !\is_string($uuid)) {
            $this->throwException('Uuid is required.');
        }
        try {
            return $this->deserialize(
                $this->client->request(Request::METHOD_GET, "$this->entrypoint/$uuid")
                    ->getBody()
                    ->getContents()
            );
        } catch (ClientException $e) {
            $this->throwException("Failed to get \"$this->entrypoint/$uuid\" SimpleCMS resource.");
        }
    }

    /**
     * @throws ResourceException
     */
    public function post(object $object): object
    {
        try {
            dump($this->serialize($object));
            die;
            return $this->deserialize(
                $this->client->request(Request::METHOD_POST, $this->entrypoint, [RequestOptions::JSON => $this->serialize($object)])
                    ->getBody()
                    ->getContents()
            );
        } catch (ClientException $e) {
            $this->throwException("Failed to post \"$this->entrypoint\" SimpleCMS resource.");
        }
    }

    /**
     * @throws ResourceException
     */
    public function put(string $uuid, array $data = []): object
    {
        // @todo: validator UUID and webmozart/assert
        if (!$uuid || !\is_string($uuid)) {
            $this->throwException('Uuid is required.');
        }

        try {
            return $this->deserialize(
                $this->client->request(Request::METHOD_PUT, "$this->entrypoint/$uuid", [RequestOptions::JSON => $data])
                    ->getBody()
                    ->getContents()
            );
        } catch (ClientException $e) {
            $this->throwException("Failed to put \"$this->entrypoint/$uuid\" SimpleCMS resource.");
        }
    }

    /**
     * @return array|object
     */
    protected function deserialize(string $json)
    {
        $data = json_decode($json);

        if (\is_array($data)) {
            return array_map(function ($item) {
                return $this->objectNormalizer->denormalize($item, $this->class, null, [
                    ObjectNormalizer::ATTRIBUTES => $this->attributes
                ]);
            }, $data);
        } else {
            return $this->objectNormalizer->denormalize($data, $this->class, null, [
                ObjectNormalizer::ATTRIBUTES => $this->attributes
            ]);
        }
    }

    protected function serialize(object $object): string
    {
        return json_encode($this->objectNormalizer->normalize($object));
    }

    /**
     * @throws ResourceException
     */
    protected function throwException(string $message, int $code = 400): void
    {
        throw new ResourceException($message, $code);
    }
}
