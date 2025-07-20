<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::with('user')
            ->where('status', PostStatus::Published->value)
            ->orderByDesc('id')
            ->paginate(10);

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): Response
    {
        if ($post->status !== PostStatus::Published) {
            abort(404);
        }

        $post->load('user');

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }
}
