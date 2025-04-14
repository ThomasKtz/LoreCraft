<?php require_once __DIR__ . '/components/header.php'; ?>

<h1>Dashboard Admin</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <form method="post">
            <td><?= $user['user_id'] ?></td>
            <td><input type="text" name="pseudo" value="<?= htmlspecialchars($user['user_pseudo']) ?>"></td>
            <td><input type="email" name="email" value="<?= htmlspecialchars($user['user_email']) ?>"></td>
            <td>
                <select name="role">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['role_id'] ?>" <?= $role['role_id'] == $user['id_role'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['role_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                <input type="submit" name="update_user" value="Modifier">
                <a href="index.php?page=admin&delete=<?= $user['user_id'] ?>" onclick="return confirm('Supprimer ce compte ?')">Supprimer</a>
            </td>
        </form>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/components/footer.php'; ?>
