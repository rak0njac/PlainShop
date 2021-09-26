@include('base')

<div class="container">
    <div class="row">
        <div class="col border rounded p-3">
            <h1 class="mb-5">Customer data</h1>
            <div class="row">
                <div class="col">
                    {{Form::open(array('url'=>'finishOrder'))}}
                    <div class="row">
                        <div class="mb-3">
                            {{Form::label('email', 'Email address', array('class'=>'form-label'))}}
                            {{Form::email('email', null, array('class'=>'form-control', 'maxlength'=>'50'))}}
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            {{Form::label('phone', 'Phone number', array('class'=>'form-label'))}}
                            {{Form::text('phone', null, array('class'=>'form-control', 'maxlength'=>'20'))}}
                            <div id="emailHelp" class="form-text">Only numbers are allowed. Example: 0982020400</div>
                        </div>
                        <div class="mb-3">
                            {{Form::label('name', 'Name and surname', array('class'=>'form-label'))}}
                            {{Form::text('name', null, array('class'=>'form-control', 'maxlength'=>'50'))}}
                            <div id="emailHelp" class="form-text">Write intercom surname if different.</div>
                        </div>
                        <div class="mb-3">
                            {{Form::label('address', 'Address line', array('class'=>'form-label'))}}
                            {{Form::text('address', null, array('class'=>'form-control', 'maxlength'=>'50'))}}
                            <div id="addressHelp" class="form-text">Write 'N/A' as house number if none.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mb-3">
                            {{Form::label('postcode', 'Post code', array('class'=>'form-label'))}}
                            {{Form::text('postcode', null, array('class'=>'form-control', 'maxlength'=>'5'))}}
                        </div>
                        <div class="col-9 mb-3">
                            {{Form::label('town', 'Town/city', array('class'=>'form-label'))}}
                            {{Form::text('town', null, array('class'=>'form-control', 'maxlength'=>'50'))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-5">
                            {{Form::button('Complete order', array('class'=>'btn btn-lg btn-warning', 'type'=>'submit'))}}
                            <span style="display: none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="col border rounded  p-3 m-3">
                    Cart contents:
                    <table class="table table-bordered mt-3">
                        <tbody>
                        @foreach($cart->details as $detail)
                            <tr>
                                <td>{{$detail->qty}}x {{$detail->product->name}}</td>
                                <td>Total</td>
                            </tr>
                        @endforeach
                        <tr></tr>
                        <td><b>Delivery type:</b> Cash on delivery</td>
                        <td>5.50</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>
