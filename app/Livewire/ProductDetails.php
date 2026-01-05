<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProductDetails extends Component
{
    public Product $product; 
    public $user_name = '';
    public $comment_body = '';

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function saveComment()
    {
        $this->validate([
            'comment_body' => 'required|min:3',
            'user_name' => 'nullable|max:50'
        ]);

        $this->product->comments()->create([
            'user_name' => $this->user_name ?: 'فاعل خير',
            'body' => $this->comment_body,
        ]);

        $this->comment_body = '';
        session()->flash('message', 'تم نشر تعليقك بنجاح!');
    }

    public function render()
    {
        // البحث عن منتجات مشابهة بنفس الاسم (الموديل) في نفس الفئة والفئة الفرعية
        $similarProducts = Product::select('id', 'name', 'price', 'category', 'sub_category', 'shop_name', 'added_by', 'user_id', 'condition')
            ->with('user:id,name,shop_name,is_approved')
            ->where('category', $this->product->category)
            ->where('sub_category', $this->product->sub_category)
            ->where('name', $this->product->name)
            ->where('id', '!=', $this->product->id)
            ->where('is_approved', true)
            ->orderBy('price', 'asc')
            ->take(10)
            ->get();
        
        // إذا لم نجد منتجات بنفس الاسم، ابحث عن منتجات مشابهة في نفس الفئة الفرعية
        if($similarProducts->isEmpty()) {
            $similarProducts = Product::select('id', 'name', 'price', 'category', 'sub_category', 'shop_name', 'added_by', 'user_id', 'condition')
                ->with('user:id,name,shop_name,is_approved')
                ->where('category', $this->product->category)
                ->where('sub_category', $this->product->sub_category)
                ->where('id', '!=', $this->product->id)
                ->where('is_approved', true)
                ->orderBy('price', 'asc')
                ->take(10)
                ->get();
        }

        // منطق الأرخص - التحقق من كون هذا أفضل سعر للموديل
        $isCheapest = false;
        if($similarProducts->isNotEmpty()) {
            $cheapestMarketPrice = $similarProducts->first()->price;
            if($this->product->price <= $cheapestMarketPrice) {
                $isCheapest = true;
            }
        } else {
            // إذا لم توجد منتجات مشابهة، فهذا هو الوحيد = الأرخص
            $isCheapest = true;
        }

        return view('livewire.product-details', [
            'similarProducts' => $similarProducts,
            'isCheapest' => $isCheapest
        ]);
    }
}