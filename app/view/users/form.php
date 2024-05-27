<?php /** @var \App\Service\User\User $user */ ?>
<?php
$userRoles = explode('|', $user->roles);

$roles = [
    'ADMIN' => 'Admin',
    'SUBSCRIBER' => 'Subscriber',
    'MANAGE' => 'Manager',
];
?>
<h1>User</h1>
<form method="POST" action="">
    <div class="mb-3">
        <input type="text" name="email" value="<?= $user->email; ?>" placeholder="Login" class="form-control"/>
    </div>
    <div class="mb-3">
        <input type="password" name="password" value="<?= $user->password; ?>" placeholder="Password" class="form-control"/>
    </div>
    <div class="mb-3">
        <select class="form-select" multiple>
            <?php foreach ($roles as $role => $roleName): ?>
            <option
                value="<?= $role ?>"
                <?php if (in_array($role, $userRoles, true)): ?>
                selected
                <?php endif; ?>
            ><?= $roleName; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
