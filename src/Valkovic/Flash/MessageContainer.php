<?php

namespace Valkovic\Flash;

class MessageContainer
{
    /**
     * @var FlashMessage[];
     */
    private $messages = [];

    /**
     *
     */
    public function serialize()
    {
        json_encode($this->messages);
    }

    /**
     * @param {string} $text Serialized text with messages
     * @return MessageContainer
     */
    public function deserialize($text)
    {
        $container = new MessageContainer();
        if(is_null($text))
            return $container;

        $container->messages = json_decode($text);
        foreach($container->messages as &$message)
            $message = (array)$message;
        return $container;
    }

    public function addMessage(FlashMessage $message)
    {
        array_push($this->messages,$message);
    }
}