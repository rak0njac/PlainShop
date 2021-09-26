@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/admin">Back to admin panel</a>
            <h1>Change password</h1>
            <form method="POST" action="change-password">
                @csrf
                <label for="old">Old (current) password</label>
                <input class="form-control" name="old" id="old" maxlength="50" type="password">
                <label for="new">New password</label>
                <input class="form-control" name="new" id="new" maxlength="50" type="password">
                <label for="new-confirm">Confirm new password</label>
                <input class="form-control" name="new-confirm" id="new-confirm" maxlength="50" type="password">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
