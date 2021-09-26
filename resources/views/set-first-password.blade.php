@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Set first password</h1>
            Welcome to PlainShop agent. Since this is your first time logging in, you need to set your password.
            <form method="POST" action="/agent/set-first-password">
                @csrf
                <input type="hidden" name="agent" value="{{$agent->id}}">
                <label for="new">New password</label>
                <input class="form-control" name="new" id="new" type="password" maxlength="50">
                <label for="new-confirm">Confirm new password</label>
                <input class="form-control" name="new-confirm" id="new-confirm" type="password" maxlength="50">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
