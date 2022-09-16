<?php




namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Post;
class BlogController extends Controller
{
    //
    public function show($slug)
    {
        $post = Post::with('tags')
            ->live()->whereSlug($slug)->first();

        if (! $post) {
            return Inertia::render('Blog/Index', ['error' => true, 'posts' => $this->getBlogPosts()]);
        }

        return Inertia::render('Blog/Show', ['post' => $post]);
    }

    private function getBlogPosts()
    {
        return Post::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')->get();
    }
}
