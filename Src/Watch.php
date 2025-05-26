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
     <link rel="stylesheet" href="Index_Styles.css">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <div class="return-home">
        <a href="index.php">Back to Home</a>
    </div>

    <div class="video-player">
        <h1><?= htmlspecialchars($title) ?></h1>

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
        <form id="likeForm">
            <button type="button" data-like="1">👍 Me gusta</button>
            <button type="button" data-like="0">👎 No me gusta</button>
        </form>
    </div>

    <div class="recommendations">
        <div class="more-from-event"></div>
        <div class="similar-talks">

        <?php foreach (array_slice($similar_taks, 0, 10) as $talk): ?>
                <div class="talk">
                    <div><a href="watch.php?title=<?= urlencode($talk[0]); ?>&url=<?= urlencode($talk[4]); ?>">Watch Talk</a></div> 

                
                    <div><iframe src="https://embed.ted.com/talks/sir_ken_robinson_do_schools_kill_creativity" frameborder="0" allow="clipboard-write; encrypted-media; gyroscope; picture-in-picture"  sandbox="allow-scripts allow-same-origin"></iframe> </div>
                    <div class="title"><?= htmlspecialchars($talk[0]); ?></div>
                    <div class="speaker">by <?= htmlspecialchars($talk[1]); ?></div>

                    <div class="views"><?= number_format((int)$talk[5]) ?> views</div>
                    <br>
                 

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>


<script>
  document.querySelectorAll('#likeForm button').forEach(btn => {
    btn.onclick = () => {
      const valor = btn.dataset.like;
      fetch('/ruta-del-servidor', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `like=${valor}`
      })
      .then(() => alert('¡Voto enviado!'))
      .catch(() => alert('Error al enviar'));
    };
  });
</script>