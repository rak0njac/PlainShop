@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            {{Form::open(array('url'=>'login'))}}
                <div class="form-group">
                    {{Form::label('email', 'Email', array('class'=>'form-label'))}}
                    {{Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email', 'maxlength'=>'50'))}}

                </div>
                <div class="form-group">
                    {{Form::label('pass', 'Password', array('class'=>'form-label'))}}
                    {{Form::text('pass', null, array('class'=>'form-control', 'placeholder'=>'Password', 'maxlength'=>'50'))}}

                </div>
                {{Form::button('Submit', array('class'=>'btn btn-primary', 'type'=>'submit'))}}
                {{Form::close()}}
        </div>
    </div>
</div>
