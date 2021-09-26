@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/admin/agent-management">Back to agent management</a>
            <h1>New agent</h1>
            <form method="POST" action="add">
                @csrf
                <label for="email">Email</label>
                <input class="form-control" name="email" id="email" maxlength="50" type="email">
                <label for="name">Name</label>
                <input class="form-control" name="name" id="name" maxlength="50" type="text">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
