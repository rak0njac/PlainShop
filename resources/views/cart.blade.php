@include('base')

{{--@foreach($products['products'] as $product)--}}
{{--    {{$product['product_id']}}, {{$product['quantity']}}, {{$product['color']}}, {{$product['size']}}<br>--}}
{{--@endforeach--}}

@foreach($products as $product)
    {{$product[0]}} + {{$product[1]}} + {{$product[2]}} + {{$product[3]}} <br>
@endforeach
