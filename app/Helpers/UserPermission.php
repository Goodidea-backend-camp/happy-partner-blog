<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class UserPermission
{
    public static function canEditField($user, $record)
    {
        if ($record && $record->id === $user->id) {
            return true;
        }elseif($record === null && $user->role === 'admin'){
            return true;
        }

        return false;
    }

    public static function canViewField($user)
    {
        if ($user->role === 'admin') {
            return true;
        }

        return false;
    }
}