<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * 判斷使用者是否可以更新特定使用者
     *
     * @param  \app\Models\User  $user  使用者實例
     * @param  \app\Models\User  $targetUser  目前使用者實例
     * @return bool 是否可以更新使用者資訊
     */
    public function update(User $user, User $targetUser): bool
    {
        // 管理員或作者可更新
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以刪除特定使用者
     */
    public function delete(User $user, User $targetUser): bool
    {
        // 任何人都不能刪除使用者
        return false;
    }

    /**
     * 判斷使用者是否可以還原特定使用者
     */
    public function restore(User $user, User $targetUser): bool
    {
        // 僅管理員可還原使用者
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以永久刪除特定使用者
     */
    public function forceDelete(User $user, User $targetUser): bool
    {
        // 任何人都不能永久刪除使用者
        return false;
    }

    /**
     * 判斷使用者是否可以編輯名稱欄位
     */
    public function editName(User $user, User $targetUser): bool
    {
        // 新增使用者，只有管理者可以編輯名稱欄位
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 僅作者可編輯姓名欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯信箱欄位
     */
    public function editEmail(User $user, User $targetUser): bool
    {
        // 新增使用者，只有管理者可以編輯信箱欄位
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 僅作者可編輯 mail欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼欄位
     */
    public function editPassword(User $user, User $targetUser): bool
    {
        // 新增使用者，只有管理者可以編輯密碼欄位
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 僅作者可編輯密碼欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼確認欄位
     */
    public function editPasswordConfirmation(User $user, User $targetUser): bool
    {
        // 新增使用者，只有管理者可以編輯密碼確認欄位
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 僅本人可編輯密碼確認欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯角色欄位
     */
    public function editRole(User $user, User $targetUser): bool
    {
        // 僅管理員可編輯角色
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以檢視角色欄位
     */
    public function viewRole(User $user, User $targetUser): bool
    {
        // 僅管理員可檢視角色
        return $user->role === 'admin';
    }

    /**
     * 判斷是否顯示編輯按鈕
     */
    public function viewEditButton(User $user, User $targetUser): bool
    {
        // 管理員或作者可見
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }
}
