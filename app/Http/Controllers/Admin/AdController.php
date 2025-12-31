<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::orderBy('id','desc')->get();
        return view('admin.ads.index', compact('ads'));
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
            'title' => 'nullable|string|max:255',
            'text_content' => 'nullable|string',
            'link' => 'nullable|url',
            'position' => 'required|in:top,middle,bottom',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('ads', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        Ad::create($data);

        return redirect()->back()->with('success', 'تم إضافة الإعلان.');
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'text_content' => 'nullable|string',
            'link' => 'nullable|url',
            'position' => 'required|in:top,middle,bottom',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            // delete old
            if ($ad->image_path) Storage::disk('public')->delete($ad->image_path);
            $data['image_path'] = $request->file('image')->store('ads', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $ad->update($data);

        return redirect()->back()->with('success', 'تم تحديث الإعلان.');
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        if ($ad->image_path) Storage::disk('public')->delete($ad->image_path);
        $ad->delete();
        return redirect()->back()->with('success', 'تم حذف الإعلان.');
    }
}
