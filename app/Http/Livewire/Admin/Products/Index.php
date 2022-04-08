<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Index extends Component
{
    use WithPagination;

    public $maderas;
    public $categories;
    public $product_id;
    public $focusedProduct;
    public $method = 'Actualizar';

    public $dir             = 'asc';
    public $search          = '';
    public $perPage         = 10;
    public $orderBy         = 'name';
    public $openEdit        = false;
    public $openDelete      = false;

    public function mount()
    {
        $this->categories = \App\Models\Category::pluck('name', 'id');
        $this->maderas    = \App\Models\WoodType::pluck('name', 'id');
    }

    public function rules()
    {
        return [
            'focusedProduct.name'          => ['required',],
            'focusedProduct.slug'          => ['required', Rule::unique('products', 'slug')->ignore($this->focusedProduct)],
            'focusedProduct.price'         => ['required', 'numeric', 'min:100'],
            'focusedProduct.stock'         => ['required', 'numeric', 'min:0'],
            'focusedProduct.description'   => ['required',],
            'focusedProduct.category_id'   => ['required', 'exists:categories,id'],
            'focusedProduct.wood_type_id'  => ['required', 'exists:wood_types,id'],
        ];
    }

    public function render()
    {
        $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->orderBy, $this->dir)
            ->paginate($this->perPage);

        return  view('livewire.admin.products.index', [
                    'products'  => $products,
                ])->layout('layouts.admin', [
                    'title'     => 'Productos',
                    'pageName'  => 'Productos'
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($field)
    {
        if ($this->orderBy == $field) {
            $this->dir = $this->dir == 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->dir = 'asc';
        }
    }

    public function createModal()
    {
        $this->focusedProduct = new Product();
        $this->method = 'Crear';
        $this->openEdit = true;
    }

    public function editModal($product_id)
    {
        $this->getFocusProduct($product_id);
        $this->openEdit = true;
    }

    public function deleteModal($product_id)
    {
        $this->getFocusProduct($product_id);
        $this->openDelete = true;
    }

    public function updateProduct()
    {
        $this->focusedProduct->slug = Str::slug($this->focusedProduct->name);
        $this->validate();
        $this->focusedProduct->save();
        $this->resetData();
    }

    public function deleteProduct()
    {
        $this->focusedProduct->delete();
        $this->reset('search');
        $this->resetData();
    }

    public function getFocusProduct($product_id)
    {
        $this->focusedProduct = Product::findOrFail($product_id);
    }

    public function resetData()
    {
        $this->reset(['openEdit', 'openDelete', 'focusedProduct', 'method']);
        $this->resetValidation();
    }
}
