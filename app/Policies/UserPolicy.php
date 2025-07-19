<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * 判斷使用者是否可以更新特定使用者
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function update(User $user, User $targetUser): bool
    {
        // 管理員或本人可更新
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以刪除特定使用者
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function delete(User $user, User $targetUser): bool
    {
        return false;
    }

    /**
     * 判斷使用者是否可以還原特定使用者
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function restore(User $user, User $targetUser): bool
    {
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以永久刪除特定使用者
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function forceDelete(User $user, User $targetUser): bool
    {
        return false;
    }

    /**
     * 判斷使用者是否可以編輯名稱欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function editName(User $user, User $targetUser): bool
    {
        // 當 $targetUser id 為 null，代表此時正在新增使用者
        if ($targetUser->id === null) {
            // admin 才可新增使用者
            return $user->role === 'admin';
        }
        // 僅本人可編輯姓名欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯信箱欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function editEmail(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }
        // 僅本人可編輯mail欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function editPassword(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }
        // 僅本人可編輯密碼欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼確認欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function editPasswordConfirmation(User $user, User $targetUser): bool
    {
        if ($targetUser->id === null) {
            return $user !== null;
        }
        // 僅本人可編輯密碼確認欄位
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯角色欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function editRole(User $user, User $targetUser): bool
    {
        // 僅管理員可編輯角色
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以檢視角色欄位
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function viewRole(User $user, User $targetUser): bool
    {
        // 僅管理員可檢視角色
        return $user->role === 'admin';
    }

    /**
     * 判斷是否顯示編輯按鈕
     *
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function viewEditButton(User $user, User $targetUser): bool
    {
        // 管理員或本人可見
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }
}
