<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/11/04
 */

namespace Polidog\ReduxReactRouterSsr\Exception;


class RedirectException extends HttpException
{
    /**
     * NotFoundException constructor.
     */
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct(301, $message, $previous, [],$code);
    }
}