    <?php
    $userName = $user['username'];

    if (!isset($userName)) { ?>
        <h1>Welcome to the Home Page</h1>
    <?php } else { ?>
        <p>Welcome <span style="font-weight: bold;"><?= htmlspecialchars($userName) ?></span> to the Home Page</p>
    <?php } ?>
    <p><?= $message ?? '' ?></p>
    <a href="/dashboard">back</a>