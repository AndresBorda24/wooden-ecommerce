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
    public $editProduct;

    public $dir         = 'asc';
    public $search      = '';
    public $perPage     = 10;
    public $openEdit    = false;
    public $orderBy     = 'name';

    protected function rules()
    {
        return [
            'editProduct.name'          => ['required',],
            'editProduct.price'         => ['required',],
            'editProduct.stock'         => ['required',],
            'editProduct.description'   => ['required',],
            'editProduct.category_id'   => ['required',],
            'editProduct.wood_type_id'  => ['required',],
        ];
    }

    public function mount()
    {
        $this->categories = \App\Models\Category::pluck('name', 'id');
        $this->maderas    = \App\Models\WoodType::pluck('name', 'id');
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

    public function editModal($product)
    {
        $this->editProduct = [
            'id'            => $product['id'],
            'name'          => $product['name'],
            'price'         => $product['price'],
            'stock'         => $product['stock'],
            'description'   => $product['description'],
            'category_id'   => $product['category_id'],
            'wood_type_id'  => $product['wood_type_id'],
        ];

        $this->openEdit = true;
    }

    public function updateProduct()
    {
        $this->editProduct['slug'] = Str::slug($this->editProduct['name']);
        $validateData = Validator::make($this->editProduct, [
            'name'          => ['required',],
            'slug'          => ['required', Rule::unique('products', 'slug')->ignore($this->editProduct['id'])],
            'price'         => ['required', 'numeric'],
            'stock'         => ['required', 'numeric', 'min:0'],
            'description'   => ['required',],
            'category_id'   => ['required', 'exists:categories,id'],
            'wood_type_id'  => ['required', 'exists:wood_types,id'],
        ], ['slug.unique' => 'Por favor cambia el titulo'])->validate();

        Product::find($this->editProduct['id'])->update($validateData);
        $this->openEdit = false;
    }
}
