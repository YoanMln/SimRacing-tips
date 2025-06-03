<main class="setting-page">
    <div class="container-title">
        <h1>Réglages des voitures</h1>
    </div>

    <?php

    $selectedTrack = isset($_POST['track']) ? $_POST['track'] : 'Nurburgring';
    ?>

    <form action="index.php?pages=settings" method="POST">
        <div class="track-container">

            <label for="track-choice">Choix du circuit</label><br>
            <select name="track" id="track-choice" onchange="this.form.submit()">
                <option value="Nurburgring" <?= ($selectedTrack == 'Nurburgring') ? 'selected' : '' ?>>Nurburgring</option>
                <option value="Spa-Francorchamps" <?= ($selectedTrack == 'Spa-Francorchamps') ? 'selected' : '' ?>>Spa-Francorchamps</option>
                <option value="RedBull Ring" <?= ($selectedTrack == 'RedBull Ring') ? 'selected' : '' ?>>RedBull Ring</option>
            </select>
        </div>
    </form>
    <section class="car-settings">
        <div class="container-card">
            <?php
            $json = file_get_contents('./data/settings.json');
            $cars = json_decode($json, true);

            if ($cars) {
                foreach ($cars as $car) {
                    if ($car['circuit'] == $selectedTrack) {
                        echo '<article class="car-card">';
                        echo '<h2>' . htmlspecialchars($car['car']) . '</h2>';
                        echo "<img class='car-image' src='./assets/img/" . htmlspecialchars($car['image']) . "' alt='" . htmlspecialchars($car['car']) . "'>";
                        echo '<ul>';
                        echo '<li><strong>Pression pneus :</strong> ' . htmlspecialchars($car['tyre_pressure']) . '</li>';
                        echo '<li><strong>pneus :</strong> ' . htmlspecialchars($car['tyres']) . '</li>';
                        echo '<li><strong>Carrossage :</strong> ' . htmlspecialchars($car['camber']) . '</li>';
                        echo '<li><strong>Circuit : </strong>' . htmlspecialchars($car['circuit']) . '</li>';
                        echo '<li><strong>Notes :</strong> ' . htmlspecialchars($car['notes']) . '</li>';
                        echo '</ul>';
                        echo '</article>';
                    }
                }
            } else {
                echo '<p>Aucun réglage trouvé.</p>';
            }
            ?>
        </div>
    </section>
</main>