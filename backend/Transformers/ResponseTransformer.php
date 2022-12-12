<?php

namespace Transformers;

class ResponseTransformer
{

    private $output = [];
    private $http_code = 200;

    public function setPayload($data, $message, $http_code = 200) {
        $this->output = [
            "status" => ($http_code == 200 ? "success" : "error"),
            "message" => $message,
            "data" => $data
        ];
        $this->http_code = $http_code;
        return $this;
    }
    
    public function getOutput() {
        return $this->output;
    }

    public function getOutputJson() {
        return json_encode($this->output);
    }

    public function getResponse() {
        http_response_code($this->http_code);
        header("Content-type: application/json");
        echo $this->getOutputJson();
    }

}