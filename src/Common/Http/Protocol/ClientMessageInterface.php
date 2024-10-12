<?php declare(strict_types=1);

namespace App\Common\Http\Protocol;

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
    
    public function getMethod(): string;
    
    public function getPath(): string;
    
    public function getHeaders(): array;
    
    public function getHeader(string $key): ?string;
    
    public function hasHeader(string $key): bool;
    
    public function setSegment(string $name, string $segment): void;
        
    public function getSegment(string $name): string|int|float|null;
    
    public function hasSegment(string $name): bool;
}