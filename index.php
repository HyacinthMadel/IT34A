<?php

require_once('config/config.php');

$user_id  = "root" ?? null;
$user_email = "root" ?? null;

$buttons = [
    'Login',
    'Logout',
    'Create Record',
    'Update Record',
    'Delete Record',
    'View Record',
    'Upload File',
    'Download',
    'Search',
    'Generate Report'
];

?>

<table border="1" cellpadding="11">

    <tr>
        <th>Action</th>
        <th>Test</th>
    </tr>

    <?php foreach ($buttons as $button): ?>

        <tr>
            <td>
                <?= htmlspecialchars($button, ENT_QUOTES, 'UTF-8') ?>
            </td>

            <td>
                <form method="post">
                    <input
                        type="hidden"
                        name="action"
                        value="<?= htmlspecialchars($button, ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <button type="submit">Test</button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    // Make sure the submitted action is valid
    if (!in_array($action, $buttons, true)) {
        echo '<p>Invalid activity action.</p>';
        exit;
    }

    // Randomly generate success/failure for testing
    $status = random_int(0, 1) === 1
        ? 'success'
        : 'failure';

    $success = logActivity(
        $pdo,
        $user_id,
        $user_email,
        $action,
        $status
    );

    if ($success) {

        echo '<p>';
        echo 'Activity: ' .
            htmlspecialchars($action, ENT_QUOTES, 'UTF-8');
        echo '<br>Status: ' .
            htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
        echo '<br>Log inserted successfully.';
        echo '</p>';

    } else {

        echo '<p>Failed to insert activity log.</p>';
    }
}

?>
