<?php
/**
 * Created by PhpStorm.
 * User: kowalsky
 * Date: 2/20/17
 * Time: 3:04 PM
 */

namespace Valkovic\Flash;


class Flash
{
    private $container;

    public function __construct(MessageContainer $container)
    {
        $this->container = $container;
    }

    public function message($text, $priority, $properties)
    {

    }

    public function none()
    {

    }

    public function primary()
    {

    }

    public function success()
    {

    }

    public function warning()
    {

    }

    public function error()
    {

    }
}