<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * 判斷是否允許登入使用者更新特定文章
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        // 管理員或作者可更新
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者刪除特定文章
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者還原特定文章
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * 判斷是否允許登入使用者永久刪除特定文章
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * 判斷是否允許登入使用者編輯文章標題
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function editTitle(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章 slug
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function editSlug(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章內容
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function editContent(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷是否允許登入使用者編輯文章狀態
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function editStatus(User $user, Post $post): bool
    {
        // 管理員或作者可編輯文章狀態
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * 判斷是否顯示刪除按鈕
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function viewDeleteButton(User $user, Post $post): bool
    {
        // 管理員或作者可見刪除按鈕
        return $user->role === 'admin' || $user->id === $post->user_id;
    }
}
