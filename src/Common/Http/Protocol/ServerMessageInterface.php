<?php declare(strict_types=1);

namespace App\Common\Http\Protocol;

interface ServerMessageInterface
{
    public const int STATUS_OK = 200;
    public const int STATUS_MOVED_PERMANENTLY = 301;
    public const int STATUS_FORBIDDEN = 403;
    public const int STATUS_NOT_FOUND = 404;
    public const int STATUS_INTERNAL_SERVER_ERROR = 500;

    public const array MESSAGES = [
        self::STATUS_OK => 'OK',
        self::STATUS_MOVED_PERMANENTLY => 'Moved Permanently',
        self::STATUS_FORBIDDEN => 'Forbidden',
        self::STATUS_NOT_FOUND => 'Not Found',
        self::STATUS_INTERNAL_SERVER_ERROR => 'Internal Server Error',
    ];
    
    public const array STATUSES = [
        self::STATUS_OK => 200,
        self::STATUS_MOVED_PERMANENTLY => 301,
        self::STATUS_FORBIDDEN => 403,
        self::STATUS_NOT_FOUND => 404,
        self::STATUS_INTERNAL_SERVER_ERROR => 500,
    ];
    
    public function getBody(): string;
    
    public function addHeader(string $header, string $value): void;

    /**
     * @param list<string> $headers
     */
    public function addHeaders(array $headers = []): void;
    
    /**
     * @return list<string>
     */
    public function getHeaders(): array;
    
    public function getStatusCode(): int;
}
