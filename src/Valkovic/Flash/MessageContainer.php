<?php
/**
 * Created by PhpStorm.
 * User: kowalsky
 * Date: 2/20/17
 * Time: 2:49 PM
 */

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