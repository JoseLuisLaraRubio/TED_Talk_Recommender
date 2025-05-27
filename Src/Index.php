<?php 
    require "Utils.php";

    $popular_talks = get_most_popular_talks(20);
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
                    
                    <div><iframe src="https://embed.ted.com/talks/sir_ken_robinson_do_schools_kill_creativity" autoplay="1" frameborder="0"  sandbox="allow-same-origin"></iframe> </div>
                    <div class="title"><?= htmlspecialchars($talk[0]); ?></div>
                    <div class="speaker">by <?= htmlspecialchars($talk[1]); ?></div>

                    <div class="views"><?= number_format((int)$talk[5]) ?> views</div>
                    <br>
                 
                    <div class="video"><a href="watch.php?title=<?= urlencode($talk[0]); ?>&url=<?= urlencode($talk[4]); ?>">Watch Talk</a></div> 
                </div>
            <?php endforeach; ?>
        </div>

        <div class="you-may-like">

        </div>

        <div class="similar-users-watched">
    
        </div>
        <div class="because-you-watched">
    
        </div>
    <div>
</body>
</html>