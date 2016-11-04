<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/11/04
 */

namespace Polidog\ReduxReactRouterSsr\Exception;


class HttpException extends RuntimeException
{
    /**
     * @var string int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * HttpException constructor.
     */
    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = [], $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

}