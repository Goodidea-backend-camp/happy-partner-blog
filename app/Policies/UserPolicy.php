<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * 判斷使用者是否可以更新特定使用者資料
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有更新權限
     */
    public function update(User $user, User $targetUser): bool
    {
        // 管理員可更新任何用戶，或用戶可更新自己的資料
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以刪除特定使用者
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有刪除權限
     */
    public function delete(User $user, User $targetUser): bool
    {
        // 因刪除用戶時未同步刪除關聯文章會導致前台錯誤，暫時禁止所有刪除操作
        return false;
    }

    /**
     * 判斷使用者是否可以還原特定使用者
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有還原權限
     */
    public function restore(User $user, User $targetUser): bool
    {
        // 僅管理員可執行用戶還原操作
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以永久刪除特定使用者
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有永久刪除權限
     */
    public function forceDelete(User $user, User $targetUser): bool
    {
        // 因刪除用戶時未同步刪除關聯文章會導致前台錯誤，暫時禁止所有永久刪除操作
        return false;
    }

    /**
     * 判斷使用者是否可以編輯姓名欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯姓名權限
     */
    public function editName(User $user, User $targetUser): bool
    {
        // 創建新用戶時：僅管理員有權限設定用戶姓名
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 編輯現有用戶時：僅允許用戶修改自己的姓名
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯信箱欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯信箱權限
     */
    public function editEmail(User $user, User $targetUser): bool
    {
        // 創建新用戶時：僅管理員有權限設定用戶信箱
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 編輯現有用戶時：僅允許用戶修改自己的信箱
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯密碼權限
     */
    public function editPassword(User $user, User $targetUser): bool
    {
        // 創建新用戶時：僅管理員有權限設定用戶密碼
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 編輯現有用戶時：僅允許用戶修改自己的密碼
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯密碼確認欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯密碼確認權限
     */
    public function editPasswordConfirmation(User $user, User $targetUser): bool
    {
        // 創建新用戶時：僅管理員有權限設定密碼確認
        if ($targetUser->id === null) {
            return $user->role === 'admin';
        }

        // 編輯現有用戶時：僅允許用戶修改自己的密碼確認
        return $user->id === $targetUser->id;
    }

    /**
     * 判斷使用者是否可以編輯角色欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有編輯角色權限
     */
    public function editRole(User $user, User $targetUser): bool
    {
        // 僅管理員可編輯用戶角色權限
        return $user->role === 'admin';
    }

    /**
     * 判斷使用者是否可以檢視角色欄位
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有檢視角色權限
     */
    public function viewRole(User $user, User $targetUser): bool
    {
        // 僅管理員可檢視用戶角色資訊
        return $user->role === 'admin';
    }

    /**
     * 判斷是否允許登入使用者檢視編輯按鈕 (即是否應顯示給使用者)
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\User  $targetUser  被操作的目標使用者
     * @return bool 是否有權限檢視編輯按鈕
     */
    public function viewEditButton(User $user, User $targetUser): bool
    {
        // 管理員可編輯任何用戶，或用戶可編輯自己的資料時顯示編輯按鈕
        return $user->role === 'admin' || $user->id === $targetUser->id;
    }
}
