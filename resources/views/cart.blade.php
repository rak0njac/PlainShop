@include('base')

{{--@foreach($products['products'] as $product)--}}
{{--    {{$product['product_id']}}, {{$product['quantity']}}, {{$product['color']}}, {{$product['size']}}<br>--}}
{{--@endforeach--}}

<div class="container">
    <div class="row">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back to previous page</a>
        <div class="col border rounded p-3">
            <h1>Cart</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr id="{{$product[6]}}">
                        <td class="align-middle">
                                <button class="btn btn-danger btn-sm cart-delete" type="submit">
                                    <span style="display: none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                        </td>
                        <td><img src="/img/avatars/{{$product[0]}}" width="50px" height="50px"></td>
                        <td>
                            <div class="d-flex align-items-center">
                                {{$product[1]}}
                                @if(!empty($product[4]))
                                    - Size: {{$product[4]}}
                                @endif
                                @if(!empty($product[3]))
                                    - Color:
                                    <label class="color-label ms-2">

                                        <span class="color-span" style="background: #{{$product[3]}};"></span>
                                    </label>
                                @endif
                            </div>
                        </td>
                        <td class="price">{{$product[2]}}</td>
                        <td class="quantity"><input class="change-quantity" style="width: 40px;" type="number" min="1" max="50" value="{{$product[5]}}"></td>
                        <td class="total-price">Total</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <button id="btn-continue" type="submit" class="btn btn-lg btn-warning mt-3" >
            Continue
            <span style="display: none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>

    </div>
</div>

<script>

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $('.cart-delete').click(function (){
        var button = $(this);

        $("#btn-continue").attr("disabled", true)
        $("#btn-continue").children("span").show();
        $(button).children("svg").hide()
        $(button).children("span").show()

        var row = $(button).parents("tr")
        var id = $(row).attr("id")


        $.ajax({
            method: "POST",
            url: "/delete-from-cart",
            data: {cookie_id:id}
        }).done(function (data){
                $("#btn-continue").attr("disabled", false)
            $("#btn-continue").children("span").hide();

            $(row).hide(250, function (){
                    $(row).remove()
                })
        })

        // "/delete-from-cart/", {"cookie_id":id}, function (){
        //     console.log('OK!')
        //     $(row).hide(500)
        // })
    })

        $(".change-quantity").change(function (){
            $("#btn-continue").attr("disabled", true)
            $("#btn-continue").children("span").show();

            var val = $(this).val()
            var row = $(this).parents("tr")
            var id = $(row).attr("id");

            $.ajax({
                method: "POST",
                url: "/cart-change-quantity",
                data: {
                    cookie_id:id,
                    quantity:val
                }
            }).done(function (data){
                $("#btn-continue").attr("disabled", false)
                $("#btn-continue").children("span").hide();
                changeTotal($(row))
            })
        })

        function changeTotal(tr)
        {
            var price = $(tr).find('.price').text()
            var quantity = $(tr).find('.quantity').children("input").val()
            var fixedPrice = parseFloat(price).toFixed(2)
            var val = fixedPrice * quantity
            //console.log(parseFloat(price))
            $(tr).find('.total-price').text(val.toFixed(2))
        }

        $(document).ready(function (){
            $("tr").each(function (){
                changeTotal($(this))
            })
        })
</script>
