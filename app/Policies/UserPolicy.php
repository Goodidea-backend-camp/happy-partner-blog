<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * 判斷使用者是否為資源的擁有者
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的使用者
     * @return bool 是否為擁有者
     */
    private function isOwner(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以更新特定使用者資料
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有更新權限
     */
    public function update(User $user, User $targetUser): bool
    {
        // 管理員可更新任何使用者，或使用者可更新自己的資料
        return $user->isAdmin() || $this->isOwner($user, $targetUser);
    }

    /**
     * 判斷使用者是否可以刪除特定使用者
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有刪除權限
     */
    public function delete(User $user, User $targetUser): bool
    {
        // 因刪除使用者時未同步刪除關聯文章會導致前台錯誤，暫時禁止所有刪除操作
        return false;
    }

    /**
     * 判斷使用者是否可以還原特定使用者
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有還原權限
     */
    public function restore(User $user, User $targetUser): bool
    {
        // 尚未允許刪除使用者，以及確保資料安全與避免非預期的還原操作，目前不對任何使用者開放此功能。
        return false;
    }

    /**
     * 判斷使用者是否可以永久刪除特定使用者
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有永久刪除權限
     */
    public function forceDelete(User $user, User $targetUser): bool
    {
        // 因刪除使用者時未同步刪除關聯文章會導致前台錯誤，暫時禁止所有永久刪除操作
        return false;
    }

    /**
     * 判斷使用者是否可以編輯姓名欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯姓名權限
     */
    public function editName(User $user, User $targetUser): bool
    {
        // 編輯現有使用者時：僅允許使用者修改自己的姓名
        if ($targetUser->exists) {
            return $this->isOwner($user, $targetUser);
        }

        // 創建新使用者時：僅管理員有權限設定使用者姓名
        return $user->isAdmin();
    }

    /**
     * 判斷使用者是否可以編輯信箱欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯信箱權限
     */
    public function editEmail(User $user, User $targetUser): bool
    {
        // 編輯現有使用者時：僅允許使用者修改自己的信箱
        if ($targetUser->exists) {
            return $this->isOwner($user, $targetUser);
        }

        // 創建新使用者時：僅管理員有權限設定使用者信箱
        return $user->isAdmin();
    }

    /**
     * 判斷使用者是否可以編輯密碼欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯密碼權限
     */
    public function editPassword(User $user, User $targetUser): bool
    {
        // 編輯現有使用者時：僅允許使用者修改自己的密碼
        if ($targetUser->exists) {
            return $this->isOwner($user, $targetUser);
        }

        // 創建新使用者時：僅管理員有權限設定使用者密碼
        return $user->isAdmin();
    }

    /**
     * 判斷使用者是否可以編輯密碼確認欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯密碼確認權限
     */
    public function editPasswordConfirmation(User $user, User $targetUser): bool
    {
        // 編輯現有使用者時：僅允許使用者修改自己的密碼確認
        if ($targetUser->exists) {
            return $this->isOwner($user, $targetUser);
        }

        // 創建新使用者時：僅管理員有權限設定密碼確認
        return $user->isAdmin();
    }

    /**
     * 判斷使用者是否可以編輯角色欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯角色權限
     */
    public function editRole(User $user, User $targetUser): bool
    {
        // 僅管理員可編輯使用者角色權限
        return $user->isAdmin();
    }

    /**
     * 判斷使用者是否可以檢視角色欄位
     *
     * @param  User  $user  當前操作的使用者
     * @param  User  $targetUser  被操作的目標使用者
     * @return bool 是否有檢視角色權限
     */
    public function viewRole(User $user, User $targetUser): bool
    {
        // 僅管理員可檢視使用者角色資訊
        return $user->isAdmin();
    }
}
