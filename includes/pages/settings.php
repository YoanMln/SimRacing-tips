<main class="setting-page">
    <div class="container-title">
        <h1>Réglages des voitures</h1>
    </div>

    <?php

    $selectedTrack = isset($_POST['track']) ? $_POST['track'] : 'Nurburgring';
    $selectedBrand = isset($_POST['brand']) ? $_POST['brand'] : 'all';

    ?>
    <div class="choice-container">
        <form action="index.php?pages=settings" method="POST">
            <div class="track-container">

                <label for="track-choice">Choix du circuit</label><br>
                <select name="track" id="track-choice" onchange="this.form.submit()">
                    <option value="Nurburgring" <?= ($selectedTrack == 'Nurburgring') ? 'selected' : '' ?>>Nurburgring</option>
                    <option value="Spa-Francorchamps" <?= ($selectedTrack == 'Spa-Francorchamps') ? 'selected' : '' ?>>Spa-Francorchamps</option>
                    <option value="RedBull Ring" <?= ($selectedTrack == 'RedBull Ring') ? 'selected' : '' ?>>RedBull Ring</option>
                </select>
            </div>



            <div class="brand-container">
                <label for="brand-choice">Choix du model</label><br>
                <select name="brand" id="brand-choice" onchange="this.form.submit()">
                    <option value="all" <?= ($selectedBrand == 'all') ? 'selected' : '' ?>>Toutes les marques</option>
                    <option value="Porsche" <?= ($selectedBrand == 'Porsche') ? 'selected' : '' ?>>Porsche</option>
                    <option value="Ferrari" <?= ($selectedBrand == 'Ferrari') ? 'selected' : '' ?>>Ferrari</option>
                    <option value="Lamborghini" <?= ($selectedBrand == 'Lamborghini') ? 'selected' : '' ?>>Lamborghini</option>
                </select>
            </div>
        </form>
    </div>
    <section class="car-settings">
        <div class="container-card">
            <?php
            $json = file_get_contents('./data/settings.json');
            $cars = json_decode($json, true);

            if ($cars) {
                foreach ($cars as $car) {
                    if (
                        $car['circuit'] == $selectedTrack &&
                        ($selectedBrand == 'all' || $car['brand'] == $selectedBrand)
                    ) {

                        echo '<article class="car-card">';
                        echo '<h2>' . htmlspecialchars($car['car']) . '</h2>';
                        echo "<img class='car-image' src='./assets/images/cars/" . htmlspecialchars($car['image']) . "' alt='" . htmlspecialchars($car['car']) . "'>";
                        echo '<ul>';
                        echo '<li><strong>Pression pneus :</strong> ' . htmlspecialchars($car['tyre_pressure']) . '</li>';
                        echo '<li><strong>pneus :</strong> ' . htmlspecialchars($car['tyres']) . '</li>';
                        echo '<li><strong>Carrossage :</strong> ' . htmlspecialchars($car['camber']) . '</li>';
                        echo '<li><strong>Circuit : </strong>' . htmlspecialchars($car['circuit']) . '</li>';
                        echo '<li><strong>Marque : </strong>' . htmlspecialchars($car['brand']) . '</li>';
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