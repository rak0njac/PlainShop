@include('base')

@foreach($products['products'] as $product)
    {{$product['product_id']}}, {{$product['quantity']}}, {{$product['color']}}, {{$product['size']}}<br>
@endforeach
