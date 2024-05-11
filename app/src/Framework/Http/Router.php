<?php

declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Http\Routing\RouteInterface;
use App\Framework\Http\Routing\RouteNotFoundException;

class Router implements RouterInterface
{
    /** @var array */
    protected $_segments = [];
    
    /** @var RouteInterface */
    protected $_collection = [];

    /**
     * @param array $segments
     */
    public function __construct(array $segments = [])
    {
        $this->setSegments($segments);
    }

    /**
     * @inheritDoc
     */
    public function handle(ClientMessageInterface $request): RouteInterface
    {
        foreach ($this->_collection as $route) {
            if (!in_array($request->getMethod(), $route->getMethods(), true)) {
                continue;
            }

            if (
                preg_match(
                    sprintf(
                        '#^%s$#',
                        $this->resolveRule($route->getRule())
                    ),
                    $request->getPath(),
                    $attributes
                )
            ) {
                foreach ($attributes as $attribute => $value) {
                    if (is_string($attribute)) {
                        $request->setAttribute($attribute, $value);
                    }
                }
    
                return $route;
            }
        }

        throw new RouteNotFoundException(sprintf('Unknown route id by path %s', $request->getPath()));
    }
    
    /**
     * @param string $name
     * @param string $rule
     * @param mixed $action
     * @param string[] $methods
     *
     * @return void
     */
    public function route(string $name, string $rule, mixed $action, array $methods = ClientMessageInterface::HTTP_METHODS): void
    {
        $this->_collection[$name] = new Route($rule, $action, $methods);
    }

    /**
     * @inheritDoc
     */
    public function getRouteUrl(string $name, array $vars = []): string
    {
        if (!array_key_exists($name, $this->_collection)) {
            throw new RouteNotFoundException(sprintf('Undefined route by name %s', $name));
        }
        
        return $this->getRealRouteUrl($this->_collection[$name]->getRule(), $vars);
    }

    /**
     * @param string $rule
     * @param array $vars
     *
     * @return string
     */
    protected function getRealRouteUrl(string $rule, array $vars): string
    {
        foreach ($vars as $var => $value) {
            $rule = $this->replaceVarUrl($rule, $var, $value);
        }

        return $rule;
    }

    /**
     * @param string $rule
     * @param string $var
     * @param string $value
     *
     * @return string
     */
    protected function replaceVarUrl(string $rule, string $var, string $value): string
    {
        return str_replace(sprintf('{%s}', $var), $value, $rule);
    }

    /**
     * @param array $segments
     *
     * @return void
     */
    protected function setSegments(array $segments): void
    {
        foreach ($segments as $segment => $regEx) {
            $this->setSegment($segment, $regEx);
        }
    }

    /**
     * @param string $segment
     * @param string $regEx
     *
     * @return void
     */
    protected function setSegment(string $segment, string $regEx): void
    {
        $this->_segments[$segment] = $regEx;
    }

    /**
     * @param string $rule
     *
     * @param string
     */
    protected function resolveRule(string $rule): string
    {
        foreach ($this->_segments as $segment => $regEx) {
            $rule = str_replace(
                sprintf('{%s}', $segment),
                sprintf('(?P<%s>%s)', $segment, $regEx),
                $rule
            );
        }

        return $rule;
    }
}
