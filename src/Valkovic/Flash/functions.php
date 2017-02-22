<?php

use Valkovic\Flash\Flash;

if (!function_exists('flash'))
{
    /**
     * Arrange for a flash message.
     * @param null|string $message Message to show
     * @param array|string('none'|'primary'|'info'|'success'|'warning'|'error') $type Type of message
     * @param array $properties Additional params
     * @return mixed
     */
    function flash($message = null, $type = [], $properties = [])
    {
        $flash = app(Flash::class);
        if (!is_null($message))
        {

            $flash->message($message,$type,$properties);
        }
        return $flash;
    }
}