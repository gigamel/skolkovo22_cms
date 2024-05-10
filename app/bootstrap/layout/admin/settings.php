<h1>Settings</h1>
<form method="POST" action="">
    <div class="mb-3">
        <input type="text" name="site_name" placeholder="Site name" class="form-control"/>
    </div>
    <div class="mb-3">
        <input type="email" name="email" placeholder="Administrator email" class="form-control"/>
    </div>
    <div class="mb-3">
        <input type="text" name="secret_key" placeholder="Secret key" class="form-control"/>
    </div>
    <div class="mb-3">
        <select class="form-select">
            <option value="EN">EN</option>
            <option value="RU">RU</option>
            <option value="UA">UA</option>
        </select>
    </div>
    <div class="mb-3">
        <select class="form-select">
            <option value="DARK">Dark</option>
            <option value="LIGHT">Light</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
