@include('base')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/admin">Back to admin panel</a>
            <h1>Order management</h1>
            <div class="border rounded p-3 mb-3">
                <h4>Search</h4>
                <div class="d-flex justify-content-between" >
{{--                    -add search order by ID, customer, GSM, email, tracking NR--}}
                    <div>
                        <label for="search-id">ID</label>
                        <input class="form-control me-5" type="text" id="search-id">
                    </div>
                    <div>
                        <label for="search-customer_name">Customer</label>
                        <input class="form-control me-5" type="text" id="search-customer_name">
                    </div>
                    <div>
                        <label for="search-customer_phone">GSM</label>
                        <input class="form-control me-5" type="text" id="search-customer_phone">
                    </div>
                    <div>
                        <label for="search-customer_email">Email</label>
                        <input class="form-control me-5" type="text" id="search-customer_email">
                    </div>
                    <div>
                        <label for="search-tracking_nr">Tracking</label>
                        <input class="form-control me-5" type="text" id="search-tracking_nr">
                    </div>
                    <div>
                        <label for="search-status">Status</label>
                        <select class="form-select me-5" id="search-status">
                            <option value="Any">
                                Any
                            </option>
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
                    </div>

                    <button class="btn btn-primary btn-search">Search</button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>GSM</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Tracking</th>
                    <th>Date/time created</th>
                    <th>Subtotal</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="body">
                @foreach($orders as $order)
                    <tr>
                        <td class="id" style="width: 150px">{{$order->id}}</td>
                        <td><input class="form-control customer_name" type="text" value="{{$order->customer_name}}"></td>
                        <td><input  class="form-control customer_address" type="text" value="{{$order->customer_address}}"></td>
                        <td style="width: 150px"><input  class="form-control customer_phone" type="text" value="{{$order->customer_phone}}"></td>
                        <td><input class="form-control customer_email" type="text" value="{{$order->customer_email}}"></td>
                        <td  style="width: 100px">
                            <select class="form-select status" data-selected="{{$order->status}}">
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
                        </td>
                        <td  style="width: 200px"><input class="form-control tracking_nr" type="text" value="{{$order->tracking_nr}}"></td>
                        <td style="width: 100px">{{$order->datetime}}</td>
                        <td  style="width: 100px">{{$order->subtotal_price}}</td>
                        <td style="width: 100px"><button type="button" class="btn btn-primary btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                </svg>
                                Save
                            </button>
                        </td>
                        <td style="width: 120px"><a href="/order-management/order-details/{{$order->id}}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                </svg>
                                Details
                            </a>
                        </td>
                        <td style="width: 110px">
                            <button type="button" class="btn btn-outline-danger btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function (){
       $(".status").each(function (index, element){
           var value = $(element).data("selected")
           $(element).children("option[value='" + value + "']").attr("selected", "selected")
       })
    })

    $('.btn-save').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var row = $(this).parents("tr");
        save(row)
    })

    $('.btn-delete').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var row = $(this).parents("tr");
        purge(row)
    })

    $('.btn-search').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var id = $("#search-id").val()
        var customer_name = $("#search-customer_name").val()
        var customer_phone = $("#search-customer_phone").val()
        var customer_email = $("#search-customer_email").val()
        var tracking_nr = $("#search-tracking_nr").val()
        var status = $("#search-status :selected").val()
        console.log(status)

        $.ajax({
            method: "POST",
            url: "/order-management/search",
            data: {id:id,customer_name:customer_name,customer_phone:customer_phone,customer_email:customer_email,tracking_nr:tracking_nr,status:status}
        }).done(function (data){
            console.log(data)
            $(".body").empty();
            data.forEach(function (key){
                $(".body").append("<tr>\
                    <td class='id' style='width: 150px'>" + key.id + "</td>\
                <td><input class='form-control customer_name' type='text' value='" + key.customer_name + "'></td>\
                <td><input  class='form-control customer_address' type='text' value='" + key.customer_address + "'></td>\
                <td style='width: 150px'><input  class='form-control customer_phone' type='text' value='" + key.customer_phone + "'></td>\
                <td><input class='form-control customer_email' type='text' value='" + key.customer_email + "'></td>\
                <td style='width: 100px'>" + key.status + "</td>\
                <td style='width: 200px'>" + key.tracking_nr + "</td>\
                <td style='width: 100px'>" + key.datetime + "</td>\
                <td style='width: 100px'>" + key.subtotal_price + "</td>\
                <td style='width: 100px'><button type='button' class='btn btn-primary btn-save'>\
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-save' viewBox='0 0 16 16'>\
                        <path d='M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z'></path>\
                    </svg>\
                    Save\
                </button>\
                </td>\
                <td style='width: 120px'><button type='button' class='btn btn-secondary'>\
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-save' viewBox='0 0 16 16'>\
                        <path d='M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z'></path>\
                    </svg>\
                    Details\
                </button>\
                </td>\
                <td style='width: 110px'>\
                    <button type='button' class='btn btn-outline-danger btn-delete'>\
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>\
                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'></path>\
                            <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'></path>\
                        </svg>\
                        Delete\
                    </button>\
                </td>\
            </tr>")
            })
            //console.log(json_encode(data))
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    })

    function save(row)
    {
        var id = $(row).find('.id').text()
        var customer_name = $(row).find('.customer_name').val()
        var customer_address = $(row).find('.customer_address').val()
        var customer_phone = $(row).find('.customer_phone').val()
        var customer_email = $(row).find('.customer_email').val()
        var tracking_nr = $(row).find('.tracking_nr').val()
        var status = $(row).find('.status').val()

        $.ajax({
            method: "POST",
            url: "/order-management/save",
            data: {id:id, customer_name:customer_name,customer_address:customer_address,customer_phone:customer_phone,customer_email:customer_email,tracking_nr:tracking_nr,status:status}
        }).done(function (data){
            console.log(data)
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }

    function purge(row)
    {
        var id = $(row).find('.id').text()

        $.ajax({
            method: "POST",
            url: "/order-management/delete",
            data: {id:id}
        }).done(function (data){
            console.log(data)
            $(row).hide();
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }
</script>
