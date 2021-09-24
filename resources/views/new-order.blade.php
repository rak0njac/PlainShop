@include('base')

<div class="container">
    <div class="row">
        <a class="btn btn-warning btn-sm mb-2" href="/agent">Back to agent panel</a>
        <h1>New order</h1>
        <div class="col-3">
            <form method="POST" class="order-form" action="/order-management/save">
                @csrf
{{--                id:id, customer_name:customer_name,customer_address:customer_address,customer_phone:customer_phone,customer_email:customer_email--}}
                <label for="customer_name">Customer</label>
                <input class="form-control" name="customer_name" id="customer_name" type="text">
                <label for="customer_address">Address</label>
                <input class="form-control" name="customer_address" id="customer_address" type="text">
                <label for="customer_phone">GSM</label>
                <input class="form-control" name="customer_phone" id="customer_phone" type="text">
                <label for="customer_email">Email</label>
                <input class="form-control" name="customer_email" id="customer_email" type="text">
            </form>
        </div>
        <div class="col-9 border rounded p-3">
            <div class="row">
                    <div class="col-4">
                        <b>Product</b>
                    </div>
                <div class="col">
                    <b>Color</b>
                </div>
                <div class="col">
                    <b>Size</b>
                </div>
                    <div class="col">
                        <b>Quantity</b>
                    </div>
                    <div class="col">
                        <b>Price</b>
                    </div>
                    <div class="col">
                        <b>Total</b>
                    </div>
                    <div class="col">
                        <b>Delete</b>
                    </div>
                </div>
            <div class="forms">
                <form method="POST" style="display: none" class="form-dummy" action="/order-management/order-details/save">
                    @csrf
                    <div class="row border rounded p-1 mb-1 d-flex align-items-center">
                        <div class="col-4">
                            <select name="product" class="form-select product">
                                <option style="display:none;" selected disabled>Select</option>
                            @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->short_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="color" class="form-select color">

                            </select>
                        </div>
                        <div class="col">
                            <select name="size" class="form-select size">

                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="qty" value="1" min="0" max="50" class="form-control qty">
                        </div>
                        <div class="col">
                            <input type="text" name="price_after_tax" class="form-control price_after_tax">
                        </div>
                        <div class="col">
                            0,00
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-danger btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <form method="POST" class="detail-forms" action="/order-management/order-details/save">
                    @csrf
                    <div class="row border rounded p-1 mb-1 d-flex align-items-center">
                        <div class="col-4">
                            <select name="product" class="form-select product">
                                <option style="display:none;" selected disabled>Select</option>
                            @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->short_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="color" class="form-select color">

                            </select>
                        </div>
                        <div class="col">
                            <select name="size" class="form-select size">

                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="qty" value="1" min="0" max="50" class="form-control qty">
                        </div>
                        <div class="col">
                            <input type="text" name="price_after_tax" class="form-control price_after_tax">
                        </div>
                        <div class="col">
                            0,00
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-danger btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <button type="button" class="btn btn-primary btn-add-detail">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
            </button>
        </div>
        <button class="btn btn-primary btn-lg mt-5 btn-save">Save</button>
    </div>
</div>

<script>
    var products;
    $(document).ready(function (){
        products = {!! $products !!}
        //products = JSON.parse(@json($products))
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '.product', function() {
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')
        var product_id = $(this).find("option:selected").val();
        var row = $(this).parents("form")
        $.ajax({
            method: "GET",
            url: "/order-management/new-order/get-colors/" + product_id,
        }).done(function (data){
            $(row).find(".color").empty()
            console.log(data)
            $(JSON.parse(data)).each(function (index, key){
                $(row).find(".color").append("<option value='" + key.id + "'>" + key.hex + "</option>")
            })
            $.ajax({
                method: "GET",
                url: "/order-management/new-order/get-sizes/" + product_id,
            }).done(function (data){
                $(row).find(".size").empty()
                console.log(data)
                $(JSON.parse(data)).each(function (index, key){
                    $(row).find(".size").append("<option value='" + key.id + "'>" + key.name + "</option>")
                })
                $.ajax({
                    method: "GET",
                    url: "/order-management/new-order/get-price/" + product_id,
                }).done(function (data){
                    $(row).find(".price_after_tax").val(data)
                    console.log(data)
                    $("#spinner-back").removeClass('show')
                    $("#spinner-front").removeClass('show')
                })
            })
        })

    });

    // $(".product").on('change',function () {
    // });
    $(document).on('click', '.btn-delete', function(){
        var form = $(this).parents('form')
        $(form).hide(250, function (){
            $(form).remove();
        });
    })


    $(".btn-add-detail").click(function (){
        var form = $(".form-dummy").first().clone();
        $(form).addClass("detail-forms")
        $(".forms").append(form);
        $(form).show(250);
    })



    // $(".btn-delete").click(function (){
    //
    // })

    $(".btn-save").click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        $.ajax($('.order-form').attr('action'),
        {
            method: $('.order-form').attr('method'),
            data: $('.order-form').serialize()
        }
        ).done(function (data){
            var order_id = data;
            $('.detail-forms').each(function(){
                valuesToSend = $(this).serialize() + "&order=" + order_id;
                $.ajax($(this).attr('action'),
                    {
                        method: $(this).attr('method'),
                        data: valuesToSend
                    }
                )
            }).promise().done(function (){
                $("#spinner-back").removeClass('show')
                $("#spinner-front").removeClass('show')
            })

        })
    })
</script>
