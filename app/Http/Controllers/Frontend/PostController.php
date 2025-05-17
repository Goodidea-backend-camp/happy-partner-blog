<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
// use Illuminate\Http\Request; // Unused import
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $posts = Post::with('user') // Eager load user for author name
                       ->where('status', 'published')
                       ->orderByDesc('id')
                       ->paginate(10); // Or your desired number per page

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): Response // Route model binding will use slug
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        $post->load('user'); // Eager load author details

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }
}
