<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class Orders extends Component
{
    public $data;
    public $dateTo;
    public $dateFrom;

    public $n = 0;
    public $dir = 'desc';
    public $openShow = false;

    public function mount()
    {
        $this->dateFrom = now()->subMonth()->toDateString();
        $this->dateTo   = now()->toDateString();
    }

    public function openDetails($index)
    {
        $this->n = $index;
        $this->openShow = true;
    }

    public function order()
    {
        $this->dir = $this->dir == 'desc' ? 'asc' : 'desc';
    }

    public function render()
    {
        $orders = auth()->user()->orders()
                ->with('products')
                ->orderBy('created_at', $this->dir)
                ->whereDate('created_at', '>=',$this->dateFrom . ' 00:00:00')
                ->whereDate('created_at', '<=',$this->dateTo . ' 24:59:00')
                ->get();

        $this->data = $orders->map(function ($o) {
            $price = 0;
            $products = $o->products;

            foreach ($products as $product) {
                $price += $product->pivot->quantity * $product->pivot->price; 
            }

            return [
                'price'    => $price,
                'date'     => $o->created_at,
                'products' => $products,
            ];
        });

        return view('livewire.users.orders');
    }
}
