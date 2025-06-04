<main class="setting-page">
    <div class="container-title">
        <h1>Réglages des voitures</h1>
    </div>

    <?php
    // Récupération des valeurs sélectionnées avec les form
    // Si aucune valeur sélectionnée = valeur par deéfaut
    $selectedTrack = isset($_POST['track']) ? $_POST['track'] : 'Nurburgring';
    $selectedBrand = isset($_POST['brand']) ? $_POST['brand'] : 'all';

    ?>
    <!-- Container choice -->
    <div class="choice-container">
        <!-- form qui se soumet automatiquement lors du chargement -->
        <form action="index.php?pages=settings" method="POST">

            <!-- Sélecteur circuit -->
            <div class="track-container">
                <label for="track-choice">Choix du circuit</label><br>
                <select name="track" id="track-choice" onchange="this.form.submit()">
                    <option value="Nurburgring" <?= ($selectedTrack == 'Nurburgring') ? 'selected' : '' ?>>Nurburgring</option>
                    <option value="Spa-Francorchamps" <?= ($selectedTrack == 'Spa-Francorchamps') ? 'selected' : '' ?>>Spa-Francorchamps</option>
                    <option value="RedBull Ring" <?= ($selectedTrack == 'RedBull Ring') ? 'selected' : '' ?>>RedBull Ring</option>
                </select>
            </div>


            <!-- Sélecteur voiture -->
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

    <!-- Section container card -->
    <section class="car-settings">
        <div class="container-card">
            <?php
            // Lecture JSON qui contient la liste des voitures
            $json = file_get_contents('./data/settings.json');
            // Conversion données JSON en tableau PHP
            $cars = json_decode($json, true);

            // Vérification des données correctement chargées
            if ($cars) {

                // Parcours chaque voitures dans les données
                foreach ($cars as $car) {
                    // Vérification critères de filtrage
                    // Circuit doit correspondre à celui sélectionné
                    // Marque doit correspondre à celle sélectionnée ou all toutes marques
                    if (
                        $car['circuit'] == $selectedTrack &&
                        ($selectedBrand == 'all' || $car['brand'] == $selectedBrand)
                    ) {
                        // Création d'une card pour chaque voiture qui correspond aux critères
                        echo '<article class="car-card">';

                        echo '<h2>' . htmlspecialchars($car['car']) . '</h2>';
                        // img de la voiture  
                        echo "<img class='car-image' src='./assets/images/cars/" . htmlspecialchars($car['image']) . "' alt='" . htmlspecialchars($car['car']) . "'>";
                        // Specs techniques   
                        echo '<ul>';
                        // Hidden
                        echo '<li class="hidden"><strong>Circuit : </strong>' . htmlspecialchars($car['circuit']) . '</li>';
                        echo '<li class="hidden" ><strong>Marque : </strong>' . htmlspecialchars($car['brand']) . '</li>';
                        // Hidden
                        echo '<li><strong>Pression pneus :</strong> ' . htmlspecialchars($car['tyre_pressure']) . '</li>';
                        echo '<li><strong>pneus :</strong> ' . htmlspecialchars($car['tyres']) . '</li>';
                        echo '<li><strong>Carrossage :</strong> ' . htmlspecialchars($car['camber']) . '</li>';
                        echo '<li><strong>Notes :</strong> ' . htmlspecialchars($car['notes']) . '</li>';
                        echo '</ul>';
                        echo '</article>';
                    }
                }
            } else {
                // Message si aucune données n'a été chargée
                echo '<p>Aucun réglage trouvé.</p>';
            }
            ?>
        </div>
    </section>
</main>