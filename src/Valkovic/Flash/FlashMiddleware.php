<?php

namespace Valkovic\Flash;

use Closure;

class FlashMiddleware
{
    private $COOKIE_NAME = 'valkovic.flash-messages';
    private $container;

    public function __construct(MessageContainer $container)
    {
        $this->container = $container;
    }

    public function Handle($request, Closure $next)
    {
        $content = $request->cookie($this->COOKIE_NAME);
        $messages = null;
        if (is_null($content))
            $messages = $this->container->deserialize('[]');
        else
            $messages = $this->container->deserialize($content);


        //TODO show old data to views
        $response = $next($request);

        //TODO flash new messages

        return $response;
    }
}