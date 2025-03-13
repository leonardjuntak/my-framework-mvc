<?php

if (!isset($user['username'])) { ?>
    <h1>Welcome to the Home Page</h1>
<?php } else { ?>
    <p>Welcome <span style="font-weight: bold;"><?= htmlspecialchars($user['username']) ?></span> to the Home Page</p>
<?php } ?>
<p><?= $message ?? '' ?></p>
<a href="/dashboard">back</a>