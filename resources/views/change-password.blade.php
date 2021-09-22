@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Change password</h1>
            <form method="POST" action="change-password">
                @csrf
                <label for="old">Old (current) password</label>
                <input class="form-control" name="old" id="old" type="password">
                <label for="new">New password</label>
                <input class="form-control" name="new" id="new" type="password">
                <label for="new-confirm">Confirm new password</label>
                <input class="form-control" name="new-confirm" id="new-confirm" type="password">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
