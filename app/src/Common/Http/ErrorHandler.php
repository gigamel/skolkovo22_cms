<?php

declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Base\Directory;
use App\Framework\Http\Error\ErrorHandlerInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;
use Error;

class ErrorHandler implements ErrorHandlerInterface
{
    /** @var string */
    protected $defaultTemplate;
    
    public function __construct()
    {
        $this->defaultTemplate = Directory::server() . '/internal_error.php';
    }
    
    /**
     * @param Error $e
     *
     * @return ServerMessageInterface
     */
    public function handle(Error $e): ServerMessageInterface
    {
        ob_start();
        require_once($this->defaultTemplate);
        $body = ob_get_contents();
        ob_end_clean();
        
        return new Response($body, 500);
    }
}
