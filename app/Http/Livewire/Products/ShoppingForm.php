<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ShoppingForm extends Component
{
    public $product;
    public $amount = 1;

    public function mount($productId)
    {
        $this->product = Product::find($productId);
    }

    protected function rules()
    {
        $max = $this->product->stock > 10 ? 5 : $this->product->stock;

        return [
            'amount' => ['required', 'numeric', 'max:'.$max ,  'min:1']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.products.shopping-form');
    }
}
