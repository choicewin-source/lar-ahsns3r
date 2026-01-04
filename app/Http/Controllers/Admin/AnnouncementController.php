<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * عرض قائمة الإعلانات
     */
    public function index()
    {
        // التحقق من صلاحيات المدير
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * حفظ إعلان جديد
     */
    public function store(Request $request)
    {
        // التحقق من صلاحيات المدير
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ], [
            'content.required' => 'يرجى إدخال نص الإعلان',
            'content.max' => 'نص الإعلان يجب أن لا يتجاوز 500 حرف',
        ]);

        Announcement::create([
            'content' => $request->content,
            'is_active' => true,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'تم إضافة الإعلان بنجاح! سيظهر في الشريط المتحرك.');
    }

    /**
     * تفعيل/إيقاف الإعلان
     */
    public function toggle($id)
    {
        // التحقق من صلاحيات المدير
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        return redirect()->route('admin.announcements.index')
            ->with('success', $announcement->is_active ? 'تم تفعيل الإعلان' : 'تم إيقاف الإعلان');
    }

    /**
     * حذف إعلان
     */
    public function destroy($id)
    {
        // التحقق من صلاحيات المدير
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'تم حذف الإعلان بنجاح');
    }
}