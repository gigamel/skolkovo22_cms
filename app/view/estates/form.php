<div class="breadcrumbs">
    <a href="/admin/estates/page/1">Estates</a> > <span>Form</span>
</div>
<h1>Estate</h1>
<form method="POST" action="">
    <div class="mb-3">
        <input type="text" name="title" placeholder="Title" class="form-control"/>
    </div>
    <div class="mb-3">
        <select class="form-select">
            <option value="cottage">Cottage</option>
            <option value="house">House</option>
            <option value="pavilion">Pavilion</option>
        </select>
    </div>
    <div class="mb-3">
        <textarea name="summary" placeholder="Summary" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <select class="form-select">
            <option value="cottage">Active</option>
            <option value="house">Disable</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
