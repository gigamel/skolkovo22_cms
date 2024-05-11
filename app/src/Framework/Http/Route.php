<?php

declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouteInterface;

class Route implements RouteInterface
{
    /** @var string[] */
    protected $methods;

    /**
     * @param string $rule
     * @param string $controller
     * @param string $action
     * @param string[] $methods
     *
     * @throws InvalidHttpMethodException
     */
    public function __construct(
        protected string $rule,
        protected string $controller,
        protected string $action,
        array $methods = [ClientMessageInterface::METHOD_GET]
    ) {
        $this->setMethods($methods);
    }

    /**
     * @inheritDoc
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @inheritDoc
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @inheritDoc
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     *
     * @return void
     *
     * @throws InvalidHttpMethodException
     */
    protected function setMethods(array $methods): void
    {
        foreach ($methods as $method) {
            if (!is_string($method)) {
                throw new InvalidHttpMethodException('HTTP method for route should be type of string');
            }

            $method = strtoupper($method);
            if (!in_array($method, ClientMessageInterface::HTTP_METHODS, true)) {
                throw new InvalidHttpMethodException('Unknown HTTP method for route');
            }

            $this->methods[] = $method;
        }
    }
}
