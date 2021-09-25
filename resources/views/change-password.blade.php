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
            <a class="btn btn-warning btn-sm mb-2" href="/admin">Back to admin panel</a>
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
