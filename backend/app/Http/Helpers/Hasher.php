<?php
/**
 * Created by PhpStorm.
 * User: zachariasz
 * Date: 2018-09-18
 * Time: 22:09
 */

namespace App\Http\Helpers;


use Illuminate\Support\Facades\Hash;

/**
 * created to make password hash
 * Class Hasher
 * @package App\Http\Helpers
 */
class Hasher
{
    public $memory = 1024;
    public $time = 2;
    public $threads = 2;

    public function __construct($toHash)
    {
        return Hash::make($toHash,[
            'memory' => $this->memory,
            'time' => $this->time,
            'threads' => $this->threads,
        ]);
    }
}