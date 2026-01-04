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
        // تقسيم الاسم للبحث الذكي
        $words = explode(' ', $this->product->name);
        $searchTerms = array_slice($words, 0, 3); // خذ أول 3 كلمات

        $similarProducts = Product::select('id', 'name', 'price', 'category', 'shop_name', 'added_by', 'user_id')
            ->with('user:id,name,shop_name') // جلب معلومات المستخدم/المتجر
            ->where('category', $this->product->category)
            ->where('id', '!=', $this->product->id)
            ->where('is_approved', true) // فقط المنتجات المعتمدة
            ->where(function($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if(mb_strlen($term) > 1) {
                        $query->where('name', 'LIKE', "%{$term}%");
                    }
                }
            })
            ->orderBy('price', 'asc')
            ->take(10)
            ->get();

        // منطق الأرخص
        $isCheapest = false;
        if($similarProducts->isNotEmpty()) {
            $cheapestMarketPrice = $similarProducts->first()->price;
            if($this->product->price <= $cheapestMarketPrice) {
                $isCheapest = true;
            }
        }

        return view('livewire.product-details', [
            'similarProducts' => $similarProducts,
            'isCheapest' => $isCheapest
        ]);
    }
}