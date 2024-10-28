<?php
class JSONview{
    public function response($body, $status = 200){
        header('Content-Type: application/json');
        $statusText = $this->_requestStatus($status);
        http_response_code($status);
        echo json_encode($body);
    }
    private function  _requestStatus($code){
        $status = array(
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            409 => 'Conflict',
            500 => 'Internal Server Error'
        );
        return (isset ($status[$code])) ? $status[$code] : $status[500];
    }
}   