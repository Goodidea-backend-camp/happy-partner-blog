<?php

namespace App\Policies;

use App\Models\User;

abstract class AuthorizablePolicy
{
    /**
     * 判斷使用者是否為管理員。
     *
     * @param  User  $user  當前操作的使用者
     * @return bool 是否為管理員
     */
    protected function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否為資源的擁有者
     *
     * @param  User  $user  當前操作的使用者
     * @param  mixed  $target  被操作的目標資源 (例如 User model或 Post model)
     * @return bool 是否為擁有者
     */
    protected function isOwner(User $user, $target): bool
    {
        // 這裡使用 ?? 運算符來處理兩種情況
        // 如果是 PostPolicy， $target 會是 Post 模型，我們判斷 $user->id === $target->user_id
        // 如果是 UserPolicy， $target 會是另一個 User 模型，我們判斷 $user->id === $target->id
        return $user->id === ($target->user_id ?? $target->id);
    }

    /**
     * 判斷使用者是否正在創建使用者
     *
     * @param  User  $targetUser  當前操作的使用者
     * @return bool 是否正在創建使用者
     */
    protected function isCreateingUser(User $targetUser)
    {
        // 若targetUser物件是空的，代表在創建使用者
        return $targetUser->id === null;
    }
}
