<?php

class Request
{
    protected $body;

    function getBody()
    {
        $this->body = json_decode(file_get_contents('php://input'), true);
        return $this->body;
    }
}
