<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $lengthAwarePaginator = Post::with('user')
            ->where('status', 'published')
            ->orderByDesc('id')
            ->paginate(10);

        return Inertia::render('Posts/Index', [
            'posts' => $lengthAwarePaginator,
        ]);
    }

    public function show(Post $post): Response
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        $post->load('user');

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }
}
