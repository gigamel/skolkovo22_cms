<?php

declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Base\Directory;
use App\Framework\Http\Error\ExceptionHandlerInterface;
use App\Framework\Http\HttpException;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;
use Exception;

class ExceptionHandler implements ExceptionHandlerInterface
{
    /** @var string */
    protected $templateDirectory;
    
    /** @var string */
    protected $defaultTemplate;
    
    public function __construct()
    {
        $this->templateDirectory = Directory::server();
        $this->defaultTemplate = $this->templateDirectory . '/internal_error.php';
    }
    
    /**
     * @param Exception $e
     *
     * @return ServerMessageInterface
     */
    public function handle(Exception $e): ServerMessageInterface
    {
        if ($e instanceof HttpException) {
            $file = sprintf('%s/%d.php', $this->templateDirectory, $e->getCode());
        }
        
        if (isset($file) && !file_exists($file)) {
            unset($file);
        }
        
        ob_start();
        require_once($file ?? $this->defaultTemplate);
        $body = ob_get_contents();
        ob_end_clean();

        return new Response($body, is_string($e->getCode()) ? 500 : ($e->getCode() ?: 500));
    }
}
