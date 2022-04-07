<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    public $open = false;
    public $product;
    public $categories;
    public $maderas;

    protected $rules = [
        'product.stock' => 'required|max:1000',
    ];

    public function mount(Product $product) 
    {
        $this->product = [
            'id'            => $product->id,
            'name'          => $product->name,
            'price'         => $product->price,
            'stock'         => $product->stock,
            'description'   => $product->description,
            'category_id'   => $product->category_id,
            'wood_type_id'  => $product->wood_type_id,
        ];

        $this->categories = \App\Models\Category::pluck('name', 'id');
        $this->maderas = \App\Models\WoodType::pluck('name', 'id');
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'product' => $this->product
        ]);
    }
}
