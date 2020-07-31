<?php

namespace Hhxsv5\SSE;

class SSE
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Start SSE Server
     * @param int $interval
     */
    public function start($interval = 3000)
    {
        while (true) {
            echo $this->event->fill();
            ob_flush();
            flush();
            // if the connection has been closed by the client we better exit the loop
            if (connection_aborted()) {
                return;
            }
            usleep($interval * 1000);
        }
    }

}
