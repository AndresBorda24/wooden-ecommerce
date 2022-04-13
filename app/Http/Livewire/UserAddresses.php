<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserAddresses extends Component
{
    public $slAddress;
    public $openAdd = false;
    public $address = [
        'town' => '',
        'neighborhood' => '',
        'house' => '',
    ];

    protected $rules = [
        'address.*' => 'required'
    ];

    protected $messages = [
        'address.*.*' => 'El campo es obligatorio'
    ];

    public function updatedSlAddress()
    {
        $this->emit('selectedAddress');

        $this->validate([
            'slAddress' => 'required|numeric|exists:addresses,id'
        ], ['slAddress.*' => 'Debes seleccionar una direccion valida']);

        $this->emit('selectedAddress', $this->slAddress);
    }

    public function addAddress()
    {
        $this->validate();
        
        \App\Models\Address::create([
            'user_id' => auth()->id(),
            'town'    => $this->address['town'],
            'house'   => $this->address['house'],
            'neighborhood'    => $this->address['neighborhood'],
        ]);

        $this->reset('openAdd', 'address');
    }

    public function render()
    {
        $addresses = auth()->user()->addresses;

        return view('livewire.user-addresses', [
            'addresses' => $addresses
        ]);
    }
}
