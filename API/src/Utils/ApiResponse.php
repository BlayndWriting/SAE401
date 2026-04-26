<?php

namespace SAE401\BikestoresApi\Utils;

/**
 * Represents an HTTP JSON response payload.
 */
class ApiResponse {

    /**
     * HTTP status code.
     *
     * @var int
     */
    private int $status;

    /**
     * Serializable response body.
     *
     * @var mixed
     */
    private $data;

    /**
     * @param int   $status HTTP status code.
     * @param mixed $data   Response payload.
     */
    public function __construct(int $status, $data){
        $this->status = $status;
        $this->data = $data;
    }

    /**
     * Returns the HTTP status code.
     *
     * @return int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * Returns the response payload.
     *
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }
}