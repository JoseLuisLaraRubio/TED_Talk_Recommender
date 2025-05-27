<?php 
    require "Utils.php";
    require "Recommend.php";

    $user_id = $_GET["user_id"] ?? 0;

    $popular_talks = get_most_popular_talks(20);
    $user_recommended_talks = get_recommendations_by_user($user_id, 20);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Index_Styles.css">
    <title>Ted talks</title>
</head>
<body>
    <h1>Ted talk Recommender</h1>

    <div class="recommendations">
        <h2>Popular Talks</h2>
        <div class="popular-talks">
            <?php foreach (array_slice($popular_talks, 0, 10) as $talk): ?>
                <div class="talk">
                    <?php
                    $embedUrl = str_replace('www.ted.com', 'embed.ted.com', $talk['url']);
                    $embedUrl = rtrim($embedUrl);
                    ?>
                    <div><iframe src="<?= $embedUrl; ?>" autoplay="0" frameborder="0"  sandbox="allow-same-origin"></iframe> </div>
                    <div class="title"><?= htmlspecialchars($talk['title']); ?></div>
                    <div class="speaker">by <?= htmlspecialchars($talk['main_speaker']); ?></div>

                    <div class="views"><?= number_format((int)$talk['views']) ?> views</div>
                    <br>
                 
                    <div class="video"><a href="watch.php?title=<?= urlencode($talk['title']); ?>&url=<?= urlencode($talk['url']); ?>">Watch Talk</a></div> 
                </div>
            <?php endforeach; ?>
        </div>

        <div class="you-may-like">

        </div>

        <h2>Similar users watched</h2>
        <div class="similar-users-watched">
            <?php foreach (array_slice($user_recommended_talks, 0, 10) as $talk): ?>
                <div class="talk">
                    <?php $embedUrl = str_replace('www.ted.com', 'embed.ted.com', $talk['url']); ?>
                    <div><iframe src="<?= $embedUrl; ?>" autoplay="0" frameborder="0"  sandbox="allow-same-origin"></iframe> </div>
                    <div class="title"><?= htmlspecialchars($talk['title']); ?></div>
                    <div class="speaker">by <?= htmlspecialchars($talk['main_speaker']); ?></div>

                    <div class="views"><?= number_format((int)$talk['views']) ?> views</div>
                    <br>
                 
                    <div class="video"><a href="watch.php?title=<?= urlencode($talk['title']); ?>&url=<?= urlencode($talk['url']); ?>">Watch Talk</a></div> 
                </div>
            <?php endforeach; ?>
        </div>

        <div class="because-you-watched">
                
        </div>
    <div>
</body>
</html>