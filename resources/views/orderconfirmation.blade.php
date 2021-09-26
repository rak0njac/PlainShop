@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>We're happy to confirm that your order has been recieved!</h1>
            An email with your order confirmation has been sent. You will get a shipping confirmation email as soon as your order is shipped. Shipping is expected in 15-20 days.
            <table class="table table-bordered mt-5 mb-5">
                <tbody>
                    <tr>
                        <td>Order number:</td>
                        <td>{{$order->id}}</td>
                    </tr>
                    <tr>
                        <td>Date/time:</td>
                        <td>{{$order->datetime}}</td>
                    </tr>
                    <tr>
                        <td>Customer:</td>
                        <td>{{$order->customer_name}}</td>
                    </tr>
                    <tr>
                        <td>Delivery address:</td>
                        <td>{{$order->customer_address}}</td>
                    </tr>
                    <tr>
                        <td>Contact phone number:</td>
                        <td>{{$order->customer_phone}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$order->customer_email}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="border rounded p-3">
                <h2>Order details</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Price+Tax</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->details as $orderdetail)
                        <tr>
                            <td>
                                {{$orderdetail->product->name}}
                            </td>
                            <td>
                                {{$orderdetail->price}}
                            </td>
                            <td>
                                {{$orderdetail->tax}}%
                            </td>
                            <td>
                                {{$orderdetail->price_after_tax}}
                            </td>
                            <td>
                                {{$orderdetail->qty}}
                            </td>
                            <td>
                                {{$orderdetail->total_price}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h4>Total: {{$order->subtotal_price}}</h4>
            </div>

            <a class="btn btn-secondary mt-3" href="/">Go to homepage</a>
        </div>
    </div>
</div>
