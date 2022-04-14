<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserPayments extends Component
{
    public $productSlug;
    public $slPayment;
    public $openAdd = false;
    public $payment = [
        'name' => '',
        'number' => '',
        'expiration' => '',
        'doc_type' => '',
        'document' => '',
    ];

    protected $rules = [
        'payment.name'       => 'required',
        'payment.number'     => 'required|max:15|min:12|unique:payments,number|regex:/^[0-9]*$/i',
        'payment.expiration' => 'required|date',
        'payment.doc_type'   => 'required|in:C.C,C.E,PASSPORT',
        'payment.document'   => 'required|max:15|min:8|regex:/^[0-9]*$/',
    ];

    protected $validationAttributes = [
        'payment.name'       => 'Name',
        'payment.number'     => 'Number',
        'payment.expiration' => 'Expiration Date',
        'payment.doc_type'   => 'Document Type',
        'payment.document'   => 'Identification',
    ];

    public function mount()
    {
        $this->productSlug = request()->route('product')->slug;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSlPayment()
    {   
        $this->emit('showCheckout', null);

        $this->validate([
            'slPayment' => 'required|numeric|exists:payments,id'
        ], ['slPayment.*' => 'Debes seleccionar una tarjeta valida']);

        $this->emit('showCheckout', $this->slPayment);
    }

    public function addPayment()
    {
        $this->validate();

        try {
            \App\Models\Payment::create([
                'user_id'          => auth()->id(),
                'name'             => $this->payment['name'],
                'number'           => $this->payment['number'],
                'expiration_date'  => Carbon::parse($this->payment['expiration'])->toDateTimeString(),
                'document'         => $this->payment['document'],
                'document_type'    => $this->payment['doc_type'],
            ]);
            $this->reset('payment', 'openAdd');
            $this->emit('nice', 'Tajeta añadida con exito!');

        } catch (\Throwable $th) {
            $this->openAdd = false;
            $this->emit('error', 'Ha ocurrido un error, intenta más tarde. Lo lamento.');
        }
    }

    public function render()
    {
        $payments = auth()->user()->payments;

        return view('livewire.user-payments', [
            'payments' => $payments
        ]);
    }
}
