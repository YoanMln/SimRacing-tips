<video autoplay muted loop id="home-video">
    <source src="assets/video/home-video.mp4">
</video>
<header>
    <div class="title-container">
        <h1 class="title">SimRacing tips</h1>
    </div>
    <h2 class="intro">Ici, vous trouverez des réglages pour vos voitures, des conseils pour améliorer vos chronos et les dernières vidéos de course</h2>
</header>
<main>
    <div class="video-container">
        <h3 class="video-title">Dernière vidéo YouTube</h3>
        <?php
        require_once 'configYT.php';

        //  Récupére la playlist d’uploads de la chaîne
        $channelUrl = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=$channelId&key=$apiKey";
        $channelData = json_decode(file_get_contents($channelUrl), true);

        if (isset($channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'])) {
            $uploadPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

            //  Récupére la dernière vidéo
            $videosUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=$uploadPlaylistId&maxResults=1&key=$apiKey";
            $videosData = json_decode(file_get_contents($videosUrl), true);

            if (isset($videosData['items'][0]['snippet']['resourceId']['videoId'])) {
                $videoId = $videosData['items'][0]['snippet']['resourceId']['videoId'];

                // Affichage  vidéo
                echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$videoId' frameborder='0' allowfullscreen></iframe>";
            } else {
                echo "<p>Impossible de récupérer la dernière vidéo.</p>";
            }
        } else {
            echo "<p>La playlist de la chaîne n’a pas été trouvée.</p>";
        }
        ?>
    </div>
</main>