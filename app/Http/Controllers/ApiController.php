<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller as BaseController;

class ApiController extends BaseController
{
    /**
     *  status code from the HTTP standard
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * standard 404 function
     * @param  string $message object not found, or pass in a message
     * @return response
     */
    public function responseNotFound ($message = "Not Found")
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * standard 422 function
     * @param  string $message object not found, or pass in a message
     * @return response
     */
    public function responseBadRequest ($message = "Bad Request", $data = [])
    {
        return $this->setStatusCode(400)->respondWithError($message, $data);
    }



    /**
     * sends the data and headers in a standard formate
     * @param  array $data    array/object of data to return
     * @param  array  $headers change response headers if needed.
     * @return response
     */
    public function respond ($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * grabs the status code, and the error code, returns the response object
     * @param  string $message message to send with the error
     * @param  array $data validation specific errors
     * @return
     */
    public function respondWithError($message, $data = [])
    {
        $error_block['error'] = [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ];

        if (!empty($data)) {
            $error_block['error']['error_data'] = $data;
        }

        return $this->respond($error_block);
    }

    /**
     * get the status code
     * @return status code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * Set the status code
     * @param statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

}