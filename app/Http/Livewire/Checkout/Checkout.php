<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public $data;
    public $product;
    public $addressId;
    public $showCheckoutButton = false;

    protected $listeners = [
        'showCheckout'
    ];

    public function mount()
    {
        // product 
        $this->product = request()->route('product');

        // product's data
        $data = decrypt(request()->route('data'));
        $this->data = explode('|', $data);
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();
            $order = \App\Models\Order::create([
                'user_id'    => auth()->id(),
                'address_id' => $this->data[2]
            ]);
    
            $order->products()->attach($this->product->id, [
                'quantity' => $this->data[0],
                'price'    => $this->data[1],
            ]);

            $this->product->update([
                'stock' => $this->product->stock - $this->data[0],
            ]);
            DB::commit();

            $data = encrypt($order->id);
            redirect()->route('sendEmail.checkout', [$data]);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            $this->emit('error', 'No se ha podido completar la compra');
        }
    }

    public function showCheckout($address = null)
    {
        if ( $this->product->stock - $this->data[0] < 0) {
            $this->emit('NoStock', 'Lo siento, no tenemos las unidades que deseas, vuelve al articulo y revisa el stock.');
        } else {
            if ($address) {
                $this->showCheckoutButton = true;
                $this->addressId = $address;
            } else {
                $this->showCheckoutButton = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }
}
