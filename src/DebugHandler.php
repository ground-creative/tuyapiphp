<?php

namespace tuyapiphp;

class DebugHandler
{
    public function __construct(protected array $_config)
    {
    }

    public function output($msg, $data = null)
    {
        if (@$this->_config['debug'] != true) {
            return;
        }
        if ($data) {
            echo $msg;
            echo '<pre>'.print_r($data, true).'</pre>';

            return;
        }
        echo $msg."<br>\n";
    }
}
