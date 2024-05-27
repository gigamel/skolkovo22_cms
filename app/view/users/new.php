<h1>User</h1>
<form method="POST" action="">
    <div class="mb-3">
        <input type="text" name="login" placeholder="Login" class="form-control"/>
    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Password" class="form-control"/>
    </div>
    <div class="mb-3">
        <select class="form-select" multiple>
            <option value="ADMIN">Admin</option>
            <option value="SUBSCRIBER" selected>Subscriber</option>
            <option value="MANAGE">Manager</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
