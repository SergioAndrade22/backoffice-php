<?php

namespace App\Models;

class ConstantMessages {
    private static $message = "successfully";

    public const internalErrorMessage = 'Internal error occured, contact sysadmin';
    public const invalidIdMessage = 'The selected object does no longer exists';
    public const errorResult = 'error';
    public const successResult = 'success';
    public static function successMessage($item, $action) {return $item." ".$action." ".self::$message;}
}
