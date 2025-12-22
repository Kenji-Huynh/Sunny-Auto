<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category', 'primaryImage']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('sku', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('short_description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $products = $query->latest()->paginate(20);
        
        // Get all categories and brands for filter dropdowns
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Search products API endpoint
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (empty($query)) {
            return response()->json([
                'products' => [],
                'suggestions' => []
            ]);
        }

        // Search products by name, SKU, short_description, or brand name
        $products = Product::with(['brand', 'category', 'primaryImage'])
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('sku', 'LIKE', "%{$query}%")
                  ->orWhere('short_description', 'LIKE', "%{$query}%")
                  ->orWhereHas('brand', function($q) use ($query) {
                      $q->where('name', 'LIKE', "%{$query}%");
                  });
            })
            ->where('status', 'active')
            ->limit(5)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'brand' => $product->brand ? $product->brand->name : null,
                    'price' => $product->msrp_price,
                    'currency' => $product->currency,
                    'formatted_price' => $product->formatted_price,
                    'image' => $product->primaryImage ? $product->primaryImage->url : null,
                ];
            });

        // Generate search suggestions based on query
        $suggestions = [
            $query,
            // Add more intelligent suggestions if needed
        ];

        return response()->json([
            'products' => $products,
            'suggestions' => $suggestions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|unique:products,sku',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'msrp_price' => 'nullable|numeric',
            'currency' => 'string|max:3',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'release_date' => 'nullable|date',
            'warranty_years' => 'nullable|integer',
            'warranty_km' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            // EV Specs
            'range_km' => 'nullable|string|max:255',
            'charge_description' => 'nullable|string|max:500',
            'zero_to_100_kmh' => 'nullable|string|max:100',
            'power_kw' => 'nullable|string|max:100',
            'drivetrain' => 'nullable|string|max:255',
            'battery_capacity_kwh' => 'nullable|string|max:255',
        ]);

        // Handle brand - create or find
        $brandId = null;
        if (!empty($validated['brand_name'])) {
            $brand = Brand::firstOrCreate(
                ['name' => $validated['brand_name']],
                ['slug' => Str::slug($validated['brand_name'])]
            );
            $brandId = $brand->id;
        }
        $validated['brand_id'] = $brandId;
        unset($validated['brand_name']);

        // Generate unique slug
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug exists and make it unique
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['slug'] = $slug;

        // Handle checkbox (if unchecked, it won't be in request)
        $validated['is_featured'] = $request->has('is_featured');

        // Create product
        $product = Product::create($validated);

        // Save EV Specs if any field is provided
        if ($this->hasEvcSpecData($request)) {
            $product->evcSpec()->create([
                'range_km' => $request->range_km,
                'charge_description' => $request->charge_description,
                'zero_to_100_kmh' => $request->zero_to_100_kmh,
                'power_kw' => $request->power_kw,
                'drivetrain' => $request->drivetrain,
                'battery_capacity_kwh' => $request->battery_capacity_kwh,
            ]);
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $position = 1;
            
            foreach ($images as $index => $image) {
                // Generate unique filename
                $filename = time() . '_' . $index . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                
                // Store image using Laravel Storage (public disk)
                $path = Storage::disk('public')->putFileAs('products', $image, $filename);
                
                // Save to media table
                $product->media()->create([
                    'type' => 'image',
                    'url' => '/storage/' . $path,
                    'alt_text' => $product->name,
                    'position' => $position,
                    'is_primary' => ($position === 1), // First image is primary
                ]);
                
                $position++;
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'brand',
            'category',
            'evcSpec',
            'physicalSpec',
            'features',
            'media'
        ]);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        $product->load(['evcSpec', 'physicalSpec', 'features', 'media']);

        return view('products.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'msrp_price' => 'nullable|numeric',
            'currency' => 'string|max:3',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'release_date' => 'nullable|date',
            'warranty_years' => 'nullable|integer',
            'warranty_km' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:media,id',
            // EV Specs - all as strings for flexible text input
            'range_km' => 'nullable|string|max:255',
            'charge_description' => 'nullable|string|max:500',
            'zero_to_100_kmh' => 'nullable|string|max:100',
            'power_kw' => 'nullable|string|max:100',
            'drivetrain' => 'nullable|string|max:255',
            'battery_capacity_kwh' => 'nullable|string|max:255',
        ]);

        // Update slug if name changed
        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $counter = 1;
            
            // Check if slug exists (excluding current product) and make it unique
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $validated['slug'] = $slug;
        }

        // Handle checkbox (if unchecked, it won't be in request)
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        // Update or Create EV Specs
        if ($this->hasEvcSpecData($request)) {
            $product->evcSpec()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'range_km' => $request->range_km,
                    'charge_description' => $request->charge_description,
                    'zero_to_100_kmh' => $request->zero_to_100_kmh,
                    'power_kw' => $request->power_kw,
                    'drivetrain' => $request->drivetrain,
                    'battery_capacity_kwh' => $request->battery_capacity_kwh,
                ]
            );
        }

        // Handle image deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $mediaId) {
                $media = $product->media()->find($mediaId);
                if ($media) {
                    // Delete physical file from storage
                    $storagePath = str_replace('/storage/', '', $media->url);
                    if (Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->delete($storagePath);
                    }
                    // Delete from database
                    $media->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $position = $product->media()->max('position') ?? 0;
            $position++;
            
            foreach ($images as $index => $image) {
                // Generate unique filename
                $filename = time() . '_' . $index . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                
                // Store image using Laravel Storage (public disk)
                $path = Storage::disk('public')->putFileAs('products', $image, $filename);
                
                // Save to media table
                $product->media()->create([
                    'type' => 'image',
                    'url' => '/storage/' . $path,
                    'alt_text' => $product->name,
                    'position' => $position,
                    'is_primary' => ($product->media()->count() === 0), // First image is primary
                ]);
                
                $position++;
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productName = $product->name;
        
        $product->delete(); // Soft delete

        return redirect()
            ->route('products.index')
            ->with('success', "Sản phẩm '{$productName}' đã được xóa!");
    }

    /**
     * Get featured products for homepage
     */
    public function getFeatured()
    {
        $products = Product::with(['brand', 'category', 'evcSpec', 'media'])
            ->where('is_featured', true)
            ->where('status', 'active')
            ->latest()
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products->map(function ($product) {
                $evcSpec = $product->evcSpec;
                
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'short_description' => $product->short_description,
                    'formatted_price' => number_format($product->msrp_price, 0, ',', '.') . ' ' . $product->currency,
                    'primary_image' => $product->media->first()?->url ?? '/imgs/products/placeholder.jpg',
                    
                    // Category
                    'category' => $product->category ? [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                        'slug' => $product->category->slug,
                    ] : null,
                    
                    // Brand
                    'brand' => $product->brand ? [
                        'id' => $product->brand->id,
                        'name' => $product->brand->name,
                        'slug' => $product->brand->slug,
                        'logo_url' => $product->brand->logo_url,
                    ] : null,
                    
                    // Full EVC Specs
                    'evc_spec' => $evcSpec ? [
                        'range_km' => $evcSpec->range_km,
                        'range_test_standard' => $evcSpec->range_test_standard,
                        'zero_to_100_kmh' => $evcSpec->zero_to_100_kmh,
                        'zero_to_100_note' => $evcSpec->zero_to_100_note,
                        'drivetrain' => $evcSpec->drivetrain,
                        'drivetrain_description' => $evcSpec->drivetrain_description,
                        'power_kw' => $evcSpec->power_kw,
                        'torque_nm' => $evcSpec->torque_nm,
                        'battery_capacity_kwh' => $evcSpec->battery_capacity_kwh,
                        'battery_type' => $evcSpec->battery_type,
                        'battery_supplier' => $evcSpec->battery_supplier,
                        'dc_fast_charging_supported' => $evcSpec->dc_fast_charging_supported,
                        'charging_connector_type' => $evcSpec->charging_connector_type,
                        'charge_10_80_min' => $evcSpec->charge_10_80_min,
                        'onboard_charger_kw' => $evcSpec->onboard_charger_kw,
                        'charge_description' => $evcSpec->charge_description,
                    ] : null,
                ];
            })
        ]);
    }

    /**
     * Get product detail by slug for API
     */
    public function getProductBySlug($slug)
    {
        $product = Product::with(['brand', 'category', 'media', 'evcSpec'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Get related products from same category
        $relatedProducts = Product::with(['brand', 'primaryImage'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(3)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'short_description' => $p->short_description,
                    'msrp_price' => $p->msrp_price,
                    'currency' => $p->currency,
                    'brand' => $p->brand ? [
                        'id' => $p->brand->id,
                        'name' => $p->brand->name,
                    ] : null,
                    'primary_image' => $p->primaryImage ? [
                        'url' => $p->primaryImage->url,
                        'alt_text' => $p->primaryImage->alt_text,
                    ] : null,
                ];
            });

        return response()->json([
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'sku' => $product->sku,
                'short_description' => $product->short_description,
                'description' => $product->description,
                'msrp_price' => $product->msrp_price,
                'currency' => $product->currency,
                'status' => $product->status,
                'is_featured' => $product->is_featured,
                'brand' => $product->brand ? [
                    'id' => $product->brand->id,
                    'name' => $product->brand->name,
                    'slug' => $product->brand->slug,
                ] : null,
                'category' => $product->category ? [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ] : null,
                'media' => $product->media->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'url' => $media->url,
                        'alt_text' => $media->alt_text,
                        'is_primary' => $media->is_primary,
                        'position' => $media->position,
                    ];
                }),
                'evc_spec' => $product->evcSpec ? [
                    'battery_capacity_kwh' => $product->evcSpec->battery_capacity_kwh,
                    'battery_type' => $product->evcSpec->battery_type,
                    'battery_supplier' => $product->evcSpec->battery_supplier,
                    'range_km' => $product->evcSpec->range_km,
                    'range_test_standard' => $product->evcSpec->range_test_standard,
                    'power_kw' => $product->evcSpec->power_kw,
                    'torque_nm' => $product->evcSpec->torque_nm,
                    'charge_10_80_min' => $product->evcSpec->charge_10_80_min,
                    'onboard_charger_kw' => $product->evcSpec->onboard_charger_kw,
                    'drivetrain' => $product->evcSpec->drivetrain,
                    'drivetrain_description' => $product->evcSpec->drivetrain_description,
                    'charge_description' => $product->evcSpec->charge_description,
                ] : null,
            ],
            'related_products' => $relatedProducts,
        ]);
    }

    /**
     * Get categories with product count for API
     */
    public function getCategories()
    {
        $categories = Category::withCount('products')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                    'products_count' => $category->products_count,
                ];
            });

        return response()->json($categories);
    }

    /**
     * Get all products with filtering and pagination for public API
     */
    public function getAllProducts(Request $request)
    {
        $query = Product::with(['brand', 'category', 'evcSpec', 'primaryImage'])
            ->where('status', 'active');

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->whereHas('brand', function($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('sku', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('short_description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Price filter
        if ($request->filled('min_price')) {
            $query->where('msrp_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('msrp_price', '<=', $request->max_price);
        }

        // Sorting
        $sortBy = $request->input('sort', 'latest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('msrp_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('msrp_price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
        }

        // Pagination
        $perPage = $request->input('per_page', 12);
        $products = $query->paginate($perPage);

        // Get all categories and brands for filter
        $categories = Category::withCount('products')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
        
        $brands = Brand::orderBy('name')->get();

        return response()->json([
            'products' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'short_description' => $product->short_description,
                    'msrp_price' => $product->msrp_price,
                    'formatted_price' => number_format($product->msrp_price, 0, ',', '.') . ' ' . $product->currency,
                    'primary_image' => $product->primaryImage?->url ?? '/imgs/products/placeholder.jpg',
                    'category' => $product->category ? [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                        'slug' => $product->category->slug,
                    ] : null,
                    'brand' => $product->brand ? [
                        'id' => $product->brand->id,
                        'name' => $product->brand->name,
                        'slug' => $product->brand->slug,
                    ] : null,
                    'evc_spec' => $product->evcSpec ? [
                        'range_km' => $product->evcSpec->range_km,
                        'power_kw' => $product->evcSpec->power_kw,
                        'battery_capacity_kwh' => $product->evcSpec->battery_capacity_kwh,
                    ] : null,
                ];
            }),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
            'filters' => [
                'categories' => $categories,
                'brands' => $brands,
            ],
        ]);
    }

    /**
     * Check if request has any EVC spec data
     */
    private function hasEvcSpecData(Request $request): bool
    {
        return $request->filled([
            'range_km', 'charge_description', 'zero_to_100_kmh',
            'power_kw', 'drivetrain', 'battery_capacity_kwh'
        ]);
    }
}
