@include('base')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Order management</h1>
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
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td style="width: 150px">{{$order->id}}</td>
                        <td><input class="form-control" type="text" value="{{$order->customer_name}}"></td>
                        <td><input  class="form-control" type="text" value="{{$order->customer_address}}"></td>
                        <td style="width: 150px"><input  class="form-control" type="text" value="{{$order->customer_phone}}"></td>
                        <td><input class="form-control" type="text" value="{{$order->customer_email}}"></td>
                        <td style="width: 100px">{{$order->status}}</td>
                        <td style="width: 200px">{{$order->tracking_nr}}</td>
                        <td style="width: 100px">{{$order->datetime}}</td>
                        <td style="width: 100px">{{$order->subtotal_price}}</td>
                        <td style="width: 100px"><button type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                </svg>
                                Save
                            </button>
                        </td>
                        <td style="width: 120px"><button type="button" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                </svg>
                                Details
                            </button>
                        </td>
                        <td style="width: 110px">
                            <button type="button" class="btn btn-outline-danger">
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