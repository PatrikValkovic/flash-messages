<?php

use Valkovic\Flash\Flash;

if (!function_exists('flash'))
{
    /**
     * Arrange for a flash message.
     * @param null|string $message Message to show
     * @param null|string('none'|'primary'|'info'|'success'|'warning'|'error') $type Type of message
     * @param null|array $params Additional params
     * @return mixed
     */
    function flash($message = null, $type = null, $params = null)
    {
        $flash = app(Flash::class);
        if (!is_null($message))
        {

            $flash->message($message,$type,$params);
        }
        return $flash;
    }
}