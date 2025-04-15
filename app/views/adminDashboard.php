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

<hr>
<h1>Liste des campagnes</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Ma tre du jeu</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($campaigns as $campaign): ?>
    <tr>
        <td><?= $campaign['campaign_id'] ?></td>
        <td><?= htmlspecialchars($campaign['campaign_name']) ?></td>
        <td><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></td>
        <td><?= htmlspecialchars($campaign['gm_name'] ?? 'N/A') ?></td>
        <td>
            <a href="index.php?page=campaign&id=<?= $campaign['campaign_id'] ?>">Voir</a>
            <a href="index.php?page=edit_campaign&id=<?= $campaign['campaign_id'] ?>">Modifier</a>
            <a href="index.php?page=admin&delete_campaign=<?= $campaign['campaign_id'] ?>" onclick="return confirm('Supprimer cette campagne ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/components/footer.php'; ?>
