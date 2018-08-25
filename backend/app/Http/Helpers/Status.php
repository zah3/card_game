<?php
/**
 * Created by PhpStorm.
 * User: zachariasz
 * Date: 2018-08-19
 * Time: 21:52
 */

namespace App\Http\Helpers;


class Status
{
    //JSON SUCCESS statuses
    public const SUCCESS_OK = 200;
    public const SUCCESS_CREATED = 201;
    public const SUCCESS_ACCEPTED = 202;

    //JSON ERROR statuses
    public const ERROR_BAD_REQUEST = 400;
    public const ERROR_UNAUTHORIZED = 401;
    public const ERROR_FORBIDDEN = 403;
    public const ERROR_NOT_FOUND = 404;
}