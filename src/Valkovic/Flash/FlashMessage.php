<?php



namespace Valkovic\Flash;


class FlashMessage
{
    /**
     * @var string Text of message
     */
    public $text;

    /**
     * @var string('none'|'primary'|'info'|'success'|'warning'|'error') Type of message
     */
    public $type;

    /**
     * @var array Additional properties of message (id, class, etc)
     */
    public $properties = [];
}