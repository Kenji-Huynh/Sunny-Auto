<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['author', 'category']);

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['draft', 'published'])) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $posts = $query->paginate(10);
        $categories = BlogCategory::all();

        return view('blogs.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Store using Laravel Storage (public disk)
            $path = Storage::disk('public')->putFileAs('blogs', $image, $imageName);
            $validated['featured_image'] = '/storage/' . $path;
        }

        // Set author
        $validated['author_id'] = auth()->id();

        // Set published_at if not provided
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blog)
    {
        $blog->load(['author', 'category', 'comments.user']);
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        // Handle image removal if requested
        if ($request->input('remove_image') == '1' && $blog->featured_image) {
            // Delete old image from storage
            $storagePath = str_replace('/storage/', '', $blog->featured_image);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
            $validated['featured_image'] = null;
        }
        
        // Handle new image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists (trước khi upload ảnh mới)
            if ($blog->featured_image) {
                $storagePath = str_replace('/storage/', '', $blog->featured_image);
                if (Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->delete($storagePath);
                }
            }

            // Upload new image
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Store using Laravel Storage (public disk)
            $path = Storage::disk('public')->putFileAs('blogs', $image, $imageName);
            $validated['featured_image'] = '/storage/' . $path;
        }

        // Set published_at if status changed to published
        if ($validated['status'] === 'published' && !$blog->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog)
    {
        // Delete featured image if exists
        if ($blog->featured_image) {
            $storagePath = str_replace('/storage/', '', $blog->featured_image);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được xóa thành công!');
    }

    /**
     * Get published blogs for frontend (JSON API)
     */
    public function getBlogs(Request $request)
    {
        $query = BlogPost::with(['author', 'category'])
            ->where('status', 'published');

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        // Order by created_at or published_at (whichever is more recent)
        $query->orderByRaw('COALESCE(published_at, created_at) DESC');

        $perPage = $request->get('per_page', 9);
        $posts = $query->paginate($perPage);

        return response()->json($posts);
    }

    /**
     * Get single blog post by slug for frontend (JSON API)
     */
    public function getBlogBySlug($slug)
    {
        $post = BlogPost::with(['author', 'category', 'approvedComments.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views
        $post->incrementViews();

        return response()->json($post);
    }

    /**
     * Get all blog categories for frontend (JSON API)
     */
    public function getCategories()
    {
        $categories = BlogCategory::withCount(['posts' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return response()->json($categories);
    }
}
