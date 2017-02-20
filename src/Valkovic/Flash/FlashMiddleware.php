<?php

namespace Valkovic\Flash;

use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\View;

class FlashMiddleware
{
    /**
     * @var string Name of
     */
    private $SESSION_KEY_NAME = 'valkovic.flash-messages';

    /**
     * @var MessageContainer Container with messages
     */
    private $container;

    /**
     * @var Store
     */
    private $session;

    public function __construct(MessageContainer $container, Store $session)
    {
        $this->container = $container;
        $this->session = $session;
    }

    public function Handle($request, Closure $next)
    {
        $content = $this->session->get($this->SESSION_KEY_NAME);
        $container = $this->container->deserialize($content);

        View::share('flashes',$container->getMessages());

        $response = $next($request);

        $this->session->flash($this->SESSION_KEY_NAME,$this->container->serialize());

        return $response;
    }
}
