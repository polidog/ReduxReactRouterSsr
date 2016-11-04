<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/11/04
 */

namespace Polidog\ReduxReactRouterSsr\Exception;


class NotFoundException extends HttpException
{

    /**
     * NotFoundException constructor.
     */
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct(404, $message, $previous, [],$code);
    }
}