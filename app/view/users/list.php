<?php /** @var \App\Service\User\User[] $users */ ?>
<div class="control-panel mb-4">
    <a href="/admin/users/add/" class="btn btn-primary">New</a>
</div>
<h1>Users</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">ROLES</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><?= $user->id; ?></th>
            <td><?= $user->email; ?></td>
            <td><?= $user->roles; ?></td>
            <td>
                <a href="/admin/users/edit/<?= $user->id; ?>" class="btn btn-primary">edit</a>
                <a href="/admin/users/delete/<?= $user->id; ?>" class="btn btn-primary">delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <a href="#">1</a>
    <span>2</span>
    <a href="#">3</a>
    <a href="#">4</a>
</div>
