<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * 判斷是否允許登入使用者更新特定文章
     *
     * @param  \app\Models\User  $user  使用者實例
     * @param  \app\Models\Post  $post  文章實例
     * @return bool 使用者是否可以更新文章資訊
     */
    public function update(User $user, Post $post): bool
    {
        // 管理員或作者可更新
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者刪除特定文章
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者還原特定文章
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * 判斷是否允許登入使用者永久刪除特定文章
     */
    public function forceDelete(User $user, Post $post): bool
    {
        // 文章基於為了避免後面有法律問題時當證據留存，所以不讓任何人進行 "永久性刪除" 的動作
        return false;
    }

    /**
     * 判斷是否允許登入使用者編輯文章標題
     */
    public function editTitle(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章 slug
     */
    public function editSlug(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章內容
     */
    public function editContent(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章狀態
     */
    public function editStatus(User $user, Post $post): bool
    {
        // 管理員或作者可編輯文章狀態
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否顯示刪除按鈕
     */
    public function viewDeleteButton(User $user, Post $post): bool
    {
        // 管理員或作者可見刪除按鈕
        return $user->role === 'admin' || $user->id === $post->user_id;
    }
}
