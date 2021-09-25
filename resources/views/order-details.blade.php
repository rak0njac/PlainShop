@include('base')

<div class="container">
    <div class="row">
        <a class="btn btn-warning btn-sm mb-2" href="/{{Auth::user()->type}}/order-management">Back to order management</a>
        <h1>Order details for order #{{$order->id}}</h1>
        <div class="col-3">
            <form method="POST" class="all-forms" action="/{{Auth::user()->type}}/order-management/save">
                @csrf
{{--                id:id, customer_name:customer_name,customer_address:customer_address,customer_phone:customer_phone,customer_email:customer_email--}}
                <input class="form-control" name="id" id="id" type="hidden" value="{{$order->id}}">
                <label for="customer_name">Customer</label>
                <input class="form-control" name="customer_name" id="customer_name" type="text" value="{{$order->customer_name}}">
                <label for="customer_address">Address</label>
                <input class="form-control" name="customer_address" id="customer_address" type="text" value="{{$order->customer_address}}">
                <label for="customer_phone">GSM</label>
                <input class="form-control" name="customer_phone" id="customer_phone" type="text" value="{{$order->customer_phone}}">
                <label for="customer_email">Email</label>
                <input class="form-control" name="customer_email" id="customer_email" type="text" value="{{$order->customer_email}}">
                <label for="tracking_nr">Tracking</label>
                <input class="form-control" name="tracking_nr" id="tracking_nr" type="text" value="{{$order->tracking_nr}}">
                <label for="status">Status</label>
                <select class="form-select" name="status" id="status" data-selected="{{$order->status}}">
                    <option value="New">
                        New
                    </option>
                    <option value="Waiting for stock">
                        Waiting for stock
                    </option>
                    <option value="Sent">
                        Sent
                    </option>
                    <option value="Deleted">
                        Deleted
                    </option>
                    <option value="Rejected">
                        Rejected
                    </option>
                    <option value="Problem">
                        Problem
                    </option>
                    <option value="Returned - Exchange">
                        Returned - Exchange
                    </option>
                    <option value="Returned - Refund">
                        Returned - Refund
                    </option>
                </select>
            </form>
        </div>
        <div class="col-9 border rounded p-3">
            <div class="row">
                    <div class="col-6">
                        <b>Product</b>
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
            @foreach($details as $detail)
                <form method="POST" class="all-forms" action="/{{Auth::user()->type}}/order-management/order-details/save">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$detail->id}}">
                    <div class="row border rounded p-1 mb-1 d-flex align-items-center">
                        <div class="col-6 d-flex align-items-center">
                            {{$detail->product->name}}
                            @if(!empty($detail->productSize))
                                - Size: {{$detail->productSize->name}}
                            @endif
                            @if(!empty($detail->productColor))
                                - Color:
                                <label class="color-label ms-2">

                                    <span class="color-span" style="background: #{{$detail->productColor->hex}};"></span>
                                </label>
                            @endif
                        </div>
                        <div class="col">
                            <input type="number" name="qty" id="qty" class="form-control" value="{{$detail->qty}}">
                        </div>
                        <div class="col">
                            <input type="text" name="price_after_tax" id="price_after_tax" class="form-control" value="{{$detail->price_after_tax}}">
                        </div>
                        <div class="col">
                            200,00
                        </div>
                        <div class="col">
                            <button type="button" value="{{$detail->id}}" class="btn btn-outline-danger btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
        <button class="btn btn-primary btn-lg mt-5 btn-save">Save</button>
    </div>
</div>

<script>
    $(document).ready(function (){
        var element = $("#status")
        var value = $(element).data("selected")
        $(element).children("option[value='" + value + "']").attr("selected", "selected")
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var deleted = [];

    $(".btn-delete").click(function (){
        deleted.push($(this).val())
        console.log(deleted)
        var form = $(this).parents('form')
        $(form).hide(250, function (){
            $(form).remove();
        });
    })

    $(".btn-save").click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        if(deleted.length === 0)
        {
            $('.all-forms').each(function(){
                valuesToSend = $(this).serialize();
                $.ajax($(this).attr('action'),
                    {
                        method: $(this).attr('method'),
                        data: valuesToSend
                    }
                ).done(function(data){
                    if(data === 'SUCCESS'){
                        $("#spinner-back").removeClass('show')
                        $("#spinner-front").removeClass('show')
                    }
                })
            })
        }
        else
        {
            $(deleted).each(function (index, value){
                console.log(value)
                $.ajax({
                    method: "POST",
                    url: "/{{Auth::user()->type}}/order-management/order-details/delete",
                    data: {id:value}
                }).done(function (data){
                    if(data === 'SUCCESS'){
                        $('.all-forms').each(function(){
                            valuesToSend = $(this).serialize();
                            $.ajax($(this).attr('action'),
                                {
                                    method: $(this).attr('method'),
                                    data: valuesToSend
                                }
                            ).done(function(data){
                                if(data === 'SUCCESS'){
                                    $("#spinner-back").removeClass('show')
                                    $("#spinner-front").removeClass('show')
                                }
                            })
                        })
                    }
                })
            })
        }
    })
</script>
