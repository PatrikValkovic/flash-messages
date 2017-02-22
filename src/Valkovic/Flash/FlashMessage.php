<?php

namespace Valkovic\Flash;

class FlashMessage
{
    /**
     * @var string Text of message
     */
    public $message;

    /**
     * @var array Additional properties of message (id, class, etc)
     */
    public $properties = [];

    /**
     * Render properties as HTML properties
     * @return string Rendered properties
     */
    public function renderProperties()
    {
        $text = "";
        foreach ($this->properties as $property=>$val)
            $text = $text . "$property=$val ";
        return trim($text);
    }
}