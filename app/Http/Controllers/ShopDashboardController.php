<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $products = Product::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('shop.dashboard', compact('products'));
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        // delete image file if exists
        if ($product->image_path) {
            try {\Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_path);} catch (\Throwable $e) {}
        }
        $product->delete();

        return redirect()->route('shop.dashboard')->with('success', 'تم حذف المنتج بنجاح');
    }
}
