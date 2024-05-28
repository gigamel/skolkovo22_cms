<?php

declare(strict_types=1);

namespace modules\auth\src\event;

use App\Framework\EventsListener\EventInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use modules\auth\src\controller\AdminController;

class CheckAuthEvent implements EventInterface
{
    public function __construct(private ClientMessageInterface $request)
    {
    }
    
    /**
     * @return bool
     */
    public function stopPropagation(): bool
    {
        return $this->request->hasAttribute('is_auth');
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        if ($this->stopPropagation()) {
            $this->request->setAttribute('controller', AdminController::class);
            $this->request->setAttribute('action', 'login');
        }
    }
}
