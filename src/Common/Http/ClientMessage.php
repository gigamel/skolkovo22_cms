<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Protocol\ClientMessageInterface;

class ClientMessage implements ClientMessageInterface
{
    /** @var list<string> */
    protected array $_headers = [];
    
    protected array $_segments = [];
    
    public function __construct()
    {
        foreach ($_SERVER as $key => $value) {
            if (0 !== \strpos($key, 'HTTP_')) {
                continue;
            }
            
            $key = ucwords(strtolower(substr($key, 5)), '_');
            
            $this->_headers[str_replace('_', '-', $key)] = $value;
        }
    }
    
    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
    
    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
    }
    
    public function getHeaders(): array
    {
        return $this->_headers;
    }
    
    public function getHeader(string $key): ?string
    {
        return $this->_headers[$key] ?? null;
    }
    
    public function hasHeader(string $key): bool
    {
        return array_key_exists($key, $this->_headers);
    }
    
    public function setSegment(string $name, string $segment): void
    {
        $this->_segments[$name] = match (true) {
            ctype_digit($segment) => (int) $segment,
            is_numeric($segment) => (float) $segment,
            default => $segment,
        };
    }
    
    public function getSegment(string $name): string|int|float|null
    {
        return $this->_segments[$name] ?? null;
    }
    
    public function hasSegment(string $name): bool
    {
        return array_key_exists($name, $this->_segments);
    }
}
