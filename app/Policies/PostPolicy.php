<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * 判斷是否允許登入使用者更新特定文章
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有更新文章權限
     */
    public function update(User $user, Post $post): bool
    {
        // 管理員可更新任何文章，或文章作者可更新自己的文章
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者刪除特定文章
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有刪除文章權限
     */
    public function delete(User $user, Post $post): bool
    {
        // 僅文章作者可刪除自己的文章
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者還原特定文章
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有還原文章權限
     */
    public function restore(User $user, Post $post): bool
    {
        // 文章還原功能尚未開發。為確保資料安全與避免非預期的還原操作，目前不對任何使用者開放此功能。
        return false;
    }

    /**
     * 判斷是否允許登入使用者永久刪除特定文章
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有永久刪除文章權限
     */
    public function forceDelete(User $user, Post $post): bool
    {
        // 為保留法律證據，禁止任何人永久刪除文章
        return false;
    }

    /**
     * 判斷是否允許登入使用者編輯文章標題
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有編輯文章標題權限
     */
    public function editTitle(User $user, Post $post): bool
    {
        // 僅文章作者可編輯自己的文章標題
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章 slug
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有編輯文章 slug 權限
     */
    public function editSlug(User $user, Post $post): bool
    {
        // 僅文章作者可編輯自己的文章 slug
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章內容
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有編輯文章內容權限
     */
    public function editContent(User $user, Post $post): bool
    {
        // 僅文章作者可編輯自己的文章內容
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章狀態
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有編輯文章狀態權限
     */
    public function editStatus(User $user, Post $post): bool
    {
        // 管理員可編輯任何文章狀態，或文章作者可編輯自己的文章狀態
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者檢視刪除按鈕 (即是否應顯示給使用者)
     *
     * @param  \app\Models\User  $user  當前操作的使用者
     * @param  \app\Models\Post  $post  被操作的目標文章
     * @return bool 是否有權限檢視刪除按鈕
     */
    public function viewDeleteButton(User $user, Post $post): bool
    {
        // 管理員或文章作者可見刪除按鈕
        return $user->role === 'admin' || $user->id === $post->user_id;
    }
}
