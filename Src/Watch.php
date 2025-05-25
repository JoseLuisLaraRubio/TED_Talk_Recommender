<?php
    $title = $_GET['title'] ?? 'Unknown Talk';
    $tedUrl = $_GET['url'] ?? '';

    $embedUrl = str_replace('www.ted.com', 'embed.ted.com', $tedUrl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <div class="return-home">
        <a href="index.php">Back to Home</a>
    </div>

    <div class="video-player">
        <h2><?= htmlspecialchars($title) ?></h2>

        <?php if ($tedUrl): ?>
            <iframe width="560" height="315"
                src="<?= htmlspecialchars($embedUrl); ?>"
                frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
            </iframe>
        <?php else: ?>
            <p>Video unavailable.</p>
        <?php endif; ?>
    </div>

    <div class="rate">
        <!-- Rating system can go here -->
    </div>

    <div class="recommendations">
        <div class="more-from-event"></div>
        <div class="similar-talks"></div>
    </div>
</body>
</html>
