<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class ProductCard extends Component
{
    public Product $product;
    public bool $showDetails = true;

    /**
     * إنشاء component جديد
     */
    public function __construct(Product $product, bool $showDetails = true)
    {
        $this->product = $product;
        $this->showDetails = $showDetails;
    }

    /**
     * عرض الـ component
     */
    public function render()
    {
        return view('components.product-card');
    }
}
