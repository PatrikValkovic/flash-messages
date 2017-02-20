<?php
namespace Valkovic\Flash;


class Flash
{
    /**
     * @var MessageContainer Container for messages
     */
    private $container;

    /**
     * Flash constructor.
     * @param MessageContainer $container Container for messages
     */
    public function __construct(MessageContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $text Text of message
     * @param string('none'|'primary'|'info'|'success'|'warning'|'error') $type
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function message($text, $type = 'none', $properties = null)
    {
        $message = new FlashMessage();
        $message->text = $text;
        $message->type = $type;
        $message->properties = is_null($properties) ? [] : $properties;
        $this->container->addMessage($message);
        return $this;
    }

    /**
     * @param string $text Text of message
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function none($text, $properties = null)
    {
        return $this->message($text, 'none', $properties);
    }

    /**
     * @param string $text Text of message
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function primary($text, $properties = null)
    {
        return $this->message($text, 'primary', $properties);

    }

    /**
     * @param string $text Text of message
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function success($text, $properties = null)
    {
        return $this->message($text, 'success', $properties);

    }

    /**
     * @param string $text Text of message
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function warning($text, $properties = null)
    {
        return $this->message($text, 'warning', $properties);

    }

    /**
     * @param string $text Text of message
     * @param array $properties Additional properties of message (id, class, etc.)
     * @return $this
     */
    public function error($text, $properties = null)
    {
        return $this->message($text, 'error', $properties);

    }
}