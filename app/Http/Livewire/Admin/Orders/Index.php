<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $dateTo;
    public $dateFrom;

    public $n = 0;
    public $dir = 'desc';
    public $openShow= false;
    public $onlyOrders = true;
    public $orderField = 'created_at';

    public function mount()
    {
        $this->dateFrom = now()->subMonth()->toDateString();
        $this->dateTo   = now()->toDateString();
    }

    public function order($field)
    {
        if ($this->orderField == $field) {
            $this->dir = $this->dir == 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderField = $field;
            $this->dir = 'asc';
        }
    }

    public function openDetails($index)
    {
        $this->n = $index;
        $this->openShow = true;
    }

    public function sentOrder(Order $order) 
    {
        $this->openShow = false;
        try {
            if ($order->trashed()) {
                $order->restore();
                $this->emit('alert', 'Se ha registrado como NO enviado!');
            } else {
                $order->delete();
                $this->emit('nice', 'Se ha registrado el envio de la venta!');
            }
        } catch (\Exception $e) {
            $this->emit('error', 'No se ha podido registrar el envio');
        }
    }

    public function render()
    {
        $orders = Order::query();

        if (! $this->onlyOrders) {
            $orders->onlyTrashed();
        }

        $orders = $orders->with('products')
            ->orderBy($this->orderField, $this->dir)
            ->whereDate('created_at', '>=',$this->dateFrom . ' 00:00:00')
            ->whereDate('created_at', '<=',$this->dateTo . ' 24:59:00')
            ->paginate(15);

        return  view('livewire.admin.orders.index', [
            'orders'    => $orders
        ])->layout('layouts.admin', [
            'title'     => 'Ventas',
            'pageName'  => 'Ventas / Ordenes'
        ]);
    }
}
