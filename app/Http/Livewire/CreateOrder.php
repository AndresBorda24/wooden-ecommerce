<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class CreateOrder extends Component
{
    protected $listeners = ['selectedAddress' => 'getAddresId'];

    public $product;
    public $address;
    public $showButton = false;
    public $amount;
    public $price;

    public function mount($amount, $price)
    {
        $this->product = request()->route('product');
        $this->price   = $price;
        $this->amount  = $amount;
    }
    
    public function getAddresId($addressId = null)
    {
        if ($addressId) {
            $this->address = $addressId;
            $this->showButton = true;
        } else {
            $this->address = null;
            $this->showButton = false;
        }
    }

    public function newOrder()
    {
        $data =  $this->amount . '|' . $this->price . '|' . $this->address;
        $d = Crypt::encrypt($data);

        redirect()->route('pay.single', [$this->product, $d]);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
