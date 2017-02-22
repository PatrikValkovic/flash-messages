<?php

namespace Valkovic\Flash;

class MessageContainer
{
    /**
     * @var FlashMessage[];
     */
    private $messages = [];

    /**
     * @return string Serialized messages
     */
    public function serialize()
    {
        return json_encode($this->messages);
    }

    /**
     * @param {string} $text Serialized text with messages
     * @return MessageContainer
     */
    public function deserialize($text)
    {
        $container = new MessageContainer();
        if (is_null($text))
            return $container;

        $container->messages = json_decode($text);
        foreach ($container->messages as &$message)
            $message->properties = (array)$message->properties;
        return $container;
    }

    /**
     * @param FlashMessage $message Message to add into container
     */
    public function addMessage(FlashMessage $message)
    {
        array_push($this->messages, $message);
    }

    /**
     * @return FlashMessage[] Array of messages
     */
    public function getMessages()
    {
        return $this->messages;
    }
}