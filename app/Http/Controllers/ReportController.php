<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * عرض صفحة الإبلاغ
     */
    public function create()
    {
        return view('pages.report');
    }

    /**
     * حفظ البلاغ
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_link' => 'nullable|string|max:500',
            'shop_name' => 'nullable|string|max:255',
            'reason' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_email' => 'nullable|email|max:255',
            'reporter_phone' => 'nullable|string|max:20',
        ]);

        Report::create($validated);

        return redirect()->back()->with('success', 'تم إرسال البلاغ بنجاح! سنقوم بمراجعته خلال 24 ساعة.');
    }

    /**
     * عرض جميع البلاغات للمدير
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $reports = Report::orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'reviewed' => Report::where('status', 'reviewed')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
        ];

        return view('admin.reports.index', compact('reports', 'stats'));
    }

    /**
     * تحديث حالة البلاغ
     */
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $report = Report::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $report->update($validated);

        return redirect()->back()->with('success', 'تم تحديث حالة البلاغ بنجاح');
    }

    /**
     * حذف بلاغ
     */
    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'غير مصرح بالوصول');
        }

        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->back()->with('success', 'تم حذف البلاغ بنجاح');
    }
}