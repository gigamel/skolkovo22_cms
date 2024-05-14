<div class="control-panel mb-4">
    <a href="/admin/users/add/" class="btn btn-primary">New</a>
</div>
<h1>Users</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Email</th>
            <th scope="col">ROLES</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>admin</td>
            <td>admin@gmail.com</td>
            <td>ADMIN</td>
            <td>
                <a href="/admin/users/edit/1" class="btn btn-primary">edit</a>
                <a href="/admin/users/delete/1" class="btn btn-primary">delete</a>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>test</td>
            <td>test@gmail.com</td>
            <td>MANAGER</td>
            <td>
                <a href="/admin/users/edit/2" class="btn btn-primary">edit</a>
                <a href="/admin/users/delete/2" class="btn btn-primary">delete</a>
            </td>
        </tr>
    </tbody>
</table>
<div class="pagination">
    <a href="#">1</a>
    <span>2</span>
    <a href="#">3</a>
    <a href="#">4</a>
</div>
