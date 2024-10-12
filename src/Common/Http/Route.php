<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Routing\RouteInterface;
use Exception;

class Route implements RouteInterface
{
    protected array $methods = [];
    
    /**
     * @param string[] $methods
     *
     * @throws Exception
     */
    public function __construct(
        protected readonly string $rule,
        protected readonly string $action,
        array $methods = ClientMessageInterface::HTTP_METHODS
    ) {
        foreach ($methods as $method) {
            $method = strtoupper(trim($method));
            if (!in_array($method, ClientMessageInterface::HTTP_METHODS, true)) {
                throw new Exception(
                    sprintf(
                        'Invalid HTTP method [%s]. Route name [%s]',
                        $method,
                        $name
                    )
                );
            }
            
            $this->methods[] = $method;
        }
    }
    
    public function getRule(): string
    {
        return $this->rule;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}