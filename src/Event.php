<?php

namespace Sokil\FraudDetector;

class Event extends \Symfony\Component\EventDispatcher\Event
{
    /**
     * @var mixed $target target object, on which event is fired
     */
    private $_target;

    private $_cancelled = false;

    /**
     * Set target object, on which event is fired
     * @param mixed $target
     * @return \Sokil\Mongo\Event
     */
    public function setTarget($target)
    {
        $this->_target = $target;
        return $this;
    }

    /**
     * Get target object, on which event is fired
     * @return mixed
     */
    public function getTarget()
    {
        return $this->_target;
    }

    /**
     * Check if operation execution cancelled
     */
    public function isCancelled()
    {
        return $this->_cancelled;
    }

    /**
     * Cancel related operation execution. If called as beforeInsert
     * handler, than insert will be cancelled.
     */
    public function cancel()
    {
        $this->_cancelled = true;

        // propagation already not need
        $this->stopPropagation();

        return $this;
    }
}