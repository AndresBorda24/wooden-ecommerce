@php
    $total = 0;
@endphp

@component('mail::message')
# Gracias por comprar en Woody<br>
Tu pedidio ha sido _registrado_ exitosamente. 

Aquí hay una tabla resumiendo tu compra:<br>

@component('mail::table')
| Articulo      | Cantidad      | Precio Unidad  |
| ------------- |:-------------:| --------------:|
@foreach ($products as $product)
| {{$product->name}} | {{$product->pivot->quantity}} | $ {{ number_format($product->pivot->price)}} |
@php
    $total += $product->pivot->price * $product->pivot->quantity;
@endphp
@endforeach
@endcomponent

@component('mail::panel')
**Valor Total Compra:** $ {{ number_format($total) }}<br>
@endcomponent
<br>
Si quieres ver el listado de tus pedidos puedes hacerlo presionando el siguiente botón: 
@component('mail::button', ['url' => $url])
Ver pedidos
@endcomponent


Un saludo,<br>
{{ config('app.name') }}
@endcomponent
