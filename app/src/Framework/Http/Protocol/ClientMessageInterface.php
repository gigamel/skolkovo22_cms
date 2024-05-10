<?php

namespace App\Framework\Http\Protocol;

interface ClientMessageInterface
{
    public const
        METHOD_OPTIONS = 'OPTIONS',
        METHOD_GET = 'GET',
        METHOD_HEAD = 'HEAD',
        METHOD_POST = 'POST',
        METHOD_PUT = 'PUT',
        METHOD_PATCH = 'PATCH',
        METHOD_DELETE = 'DELETE',
        METHOD_TRACE = 'TRACE',
        METHOD_CONNECT = 'CONNECT'
    ;

    public const HTTP_METHODS = [
        self::METHOD_OPTIONS,
        self::METHOD_GET,
        self::METHOD_HEAD,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_PATCH,
        self::METHOD_DELETE,
        self::METHOD_TRACE,
        self::METHOD_CONNECT,
    ];

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function setAttribute(string $name, string $value): void;

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @param string $name
     *
     * @return string|null
     */
    public function getAttribute(string $name): ?string;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute(string $name): bool;
}
