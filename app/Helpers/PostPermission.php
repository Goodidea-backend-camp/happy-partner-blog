<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PostPermission
{
    public static function canEditField($user, $record, $field)
    {
        if ($record && $record->user_id === $user->id) {
            return true;
        }elseif($record === null){
            return true;
        }elseif ($user->role === 'admin') {
            return $field === 'status';
        }

        return false;
    }

    public static function canViewField($user, $record)
    {
        if ($record && $record->user_id === $user->id) {
            return true;
        }

        return false;
    }
}