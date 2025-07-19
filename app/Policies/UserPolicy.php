<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    // 判斷使用者是否可以更新特定使用者。
    public function update(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id || $user->role === 'admin';
    }

    // 判斷使用者是否可以刪除特定使用者。
    public function delete(User $user, User $targetUser): bool
    {
        return false;
    }

    // 判斷使用者是否可以還原特定使用者。
    public function restore(User $user, User $targetUser): bool
    {
        return $user->role === 'admin';
    }

    // 判斷使用者是否可以永久刪除特定使用者。
    public function forceDelete(User $user, User $targetUser): bool
    {
        return false;
    }

    // 判斷使用者是否可以編輯名稱欄位。
    public function editName(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        return $user->id === $targetUser->id;
    }

    // 判斷使用者是否可以編輯信箱欄位。
    public function editEmail(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        return $user->id === $targetUser->id;
    }

    // 判斷使用者是否可以編輯密碼欄位。
    public function editPassword(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        return $user->id === $targetUser->id;
    }

    // 判斷使用者是否可以編輯密碼確認欄位。
    public function editPasswordConfirmation(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user !== null;
        }

        return $user->id === $targetUser->id;
    }

    // 判斷使用者是否可以編輯角色欄位。
    public function editRole(User $user, User $targetUser): bool
    {
        return $user->role === 'admin';
    }

    // 判斷使用者是否可以檢視角色欄位。
    public function viewRole(User $user, User $targetUser): bool
    {
        return $user->role === 'admin';
    }

    // 判斷是否顯示編輯按鈕。
    public function viewEditButton(User $user, User $targetUser): bool
    {
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }
}
