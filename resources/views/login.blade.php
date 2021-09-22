@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger mb-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::open(array('url'=>'login'))}}
                <div class="form-group">
                    {{Form::label('email', 'Email', array('class'=>'form-label'))}}
                    {{Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email'))}}

                </div>
                <div class="form-group">
                    {{Form::label('pass', 'Password', array('class'=>'form-label'))}}
                    {{Form::text('pass', null, array('class'=>'form-control', 'placeholder'=>'Password'))}}

                </div>
                {{Form::button('Submit', array('class'=>'btn btn-primary', 'type'=>'submit'))}}
                {{Form::close()}}
        </div>
    </div>
</div>
