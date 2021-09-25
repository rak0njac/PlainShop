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
            <h1>Set first password</h1>
            Welcome to PlainShop agent. Since this is your first time logging in, you need to set your password.
            <form method="POST" action="/agent/set-first-password">
                @csrf
                <input type="hidden" name="agent" value="{{$agent->id}}">
                <label for="new">New password</label>
                <input class="form-control" name="new" id="new" type="password">
                <label for="new-confirm">Confirm new password</label>
                <input class="form-control" name="new-confirm" id="new-confirm" type="password">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
