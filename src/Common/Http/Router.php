<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\Routing\RouterInterface;
use App\Common\Http\Routing\RoutesCollectionInterface;
use App\Common\Http\Routing\RouteInterface;

class Router implements RouterInterface
{
    protected array $_segments = [];
    
    public function __construct(
        protected RoutesCollectionInterface $collection,
        array $segments = []
    ) {
        foreach ($segments as $segment => $regEx) {
            $this->setSegment($segment, $regEx);
        }
    }
    
    /**
     * @throws HttpException
     */
    public function handleClientMessage(ClientMessageInterface $clientMessage): RouteInterface
    {
        foreach ($this->collection->getCollection() as $name => $route) {
            if (!in_array($clientMessage->getMethod(), $route->getMethods(), true)) {
                continue;
            }
            
            if (
                preg_match(
                    '~^' . $this->normalizeRule($route->getRule()) . '$~',
                    $clientMessage->getPath(),
                    $segments
                )
            ) {
                foreach ($segments as $name => $segment) {
                    if (is_string($name)) {
                        $clientMessage->setSegment($name, $segment);
                    }
                }
                
                return $route;
            }
        }
        
        throw new HttpException('Route not found', ServerMessageInterface::STATUS_NOT_FOUND);
    }
    
    public function setSegment(string $segment, string $regEx): void
    {
        $this->_segments[$segment] = sprintf('(?P<%s>%s)', $segment, $regEx);
    }
    
    protected function normalizeRule(string $rule): string
    {
        if (!$this->hasSegment($rule)) {
            return $rule;
        }
        
        foreach ($this->_segments as $segment => $regEx) {
            $rule = str_replace(sprintf('{%s}', $segment), $regEx, $rule);
            
            if (!$this->hasSegment($rule)) {
                break;
            }
        }
        
        return $rule;
    }
    
    protected function hasSegment(string $rule): bool
    {
        return str_contains($rule, '{');
    }
}
