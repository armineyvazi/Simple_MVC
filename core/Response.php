<?php



namespace app\core;

class Response{
    /**
     * @param error/status_code
     */

    public function setStatusCode(int $code)
    {
       return  http_response_code($code);
    }

}
