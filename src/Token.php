<?php

namespace tuyapiphp;

class Token
{
    protected $_token = '';

    protected $_endpoints =
        [
            'get_new' => '/v1.0/token?grant_type=1',
            'get_refresh' => '/v1.0/token/{refresh_token}',
        ];

    public function __construct(protected array $_config)
    {
    }

    public function __call($name, $args = [])
    {
        $request = new Caller($this->_config, $this->_endpoints, $this->_token);

        return $request->send($name, $args);
    }
}
