<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'يجب إدخال اسم المنتج.',
            'name.max' => 'يجب ألا يتجاوز اسم المنتج 255 حرفًا.',
            'image.image' => 'يجب أن يكون الملف المرفق صورة.',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة JPEG أو PNG أو JPG أو GIF.',
            'image.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت.',
            'quantity.required' => 'يجب إدخال الكمية.',
            'quantity.integer' => 'يجب أن تكون الكمية رقمًا صحيحًا.',
            'quantity.min' => 'يجب أن تكون الكمية على الأقل 1.',
            'price.required' => 'يجب إدخال السعر.',
            'price.numeric' => 'يجب أن يكون السعر رقمًا.',
            'price.min' => 'يجب أن يكون السعر 0 أو أكثر.',
            'description.max' => 'يجب ألا يتجاوز الوصف 500 حرف.',
            'category_id.required' => 'يجب اختيار فئة للمنتج.',
            'category_id.exists' => 'الفئة المختارة غير صحيحة.',
        ]);

        // Upload the image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Create Product
        Product::create([
            'name' => $request->name,
            'image' => $imagePath,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get the Product from the Databease
        $product = Product::findOrFail($id);

        // Check if the admin made any changes
        $originalData = [
            'name' => $product->name,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'description' => $product->description,
            'category_id' => $product->category_id,
        ];

        $newData = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        // Check if nothing changed
        if (empty(array_diff_assoc($newData, $originalData)) && !$request->hasFile('image')) {
            return redirect()->route('products.index')->with('info', 'لم تقم بأي تعديل!');
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'يجب إدخال اسم المنتج.',
            'name.max' => 'يجب ألا يتجاوز اسم المنتج 255 حرفًا.',
            'image.image' => 'يجب أن يكون الملف المرفق صورة.',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة JPEG أو PNG أو JPG أو GIF.',
            'image.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت.',
            'quantity.required' => 'يجب إدخال الكمية.',
            'quantity.integer' => 'يجب أن تكون الكمية رقمًا صحيحًا.',
            'quantity.min' => 'يجب أن تكون الكمية على الأقل 1.',
            'price.required' => 'يجب إدخال السعر.',
            'price.numeric' => 'يجب أن يكون السعر رقمًا.',
            'price.min' => 'يجب أن يكون السعر 0 أو أكثر.',
            'description.max' => 'يجب ألا يتجاوز الوصف 500 حرف.',
            'category_id.required' => 'يجب اختيار فئة للمنتج.',
            'category_id.exists' => 'الفئة المختارة غير صحيحة.',
        ]);

        // Update the image if there is a new image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $newData['image'] = $imagePath;
        }

        // update!
        $product->update($newData);

        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم خذف المنتج بنجاخ');
    }
}
