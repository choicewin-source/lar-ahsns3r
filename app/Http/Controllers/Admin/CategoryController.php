<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) abort(403);
            return $next($request);
        });
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'icon' => 'nullable|string|max:10',
            'subs' => 'nullable',
        ]);

        // allow subs as textarea (newline-separated) or array
        if (is_string($data['subs'] ?? null)) {
            $lines = preg_split('/\r?\n/', $data['subs']);
            $subs = array_values(array_filter(array_map('trim', $lines)));
            $data['subs'] = $subs;
        }
        $data['subs'] = $data['subs'] ?? [];
        Category::create($data);

        return redirect()->back()->with('success', 'تمت إضافة الفئة.');
    }

    public function update(Request $request, $id)
    {
        $cat = Category::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:categories,slug,{$id}",
            'icon' => 'nullable|string|max:10',
            'subs' => 'nullable',
        ]);
        if (is_string($data['subs'] ?? null)) {
            $lines = preg_split('/\r?\n/', $data['subs']);
            $subs = array_values(array_filter(array_map('trim', $lines)));
            $data['subs'] = $subs;
        }
        $cat->update($data);

        return redirect()->back()->with('success', 'تم تحديث الفئة.');
    }

    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        return redirect()->back()->with('success', 'تم حذف الفئة.');
    }
}
