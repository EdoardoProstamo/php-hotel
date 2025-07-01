<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>php-hotels</title>
</head>

<body>

    <?php

    $parking_request = false;

    if (isset($_GET['parking']) && $_GET['parking'] == "on") {

        $parking_request = true;
    }
    var_dump($parking_request);
    ?>

    <h1>Hotel PHP</h1>

    <!-- form filtro -->
    <form action="" class="container mt-5 p-4 border rounded bg-light shadow-sm">
        <div class="mb-4">
            <h5 class="mb-2">Voto medio hotel?</h5>
            <div class="d-flex flex-wrap gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="inlineCheckbox1" value="1">
                    <label class="form-check-label" for="inlineCheckbox1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2">
                    <label class="form-check-label" for="inlineCheckbox2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="3">
                    <label class="form-check-label" for="inlineCheckbox3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="4">
                    <label class="form-check-label" for="inlineCheckbox4">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="5">
                    <label class="form-check-label" for="inlineCheckbox5">5</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="parking" name="parking">
                <label class="form-check-label" for="parking">
                    Parcheggio incluso
                </label>
            </div>
        </div>
        <button class="btn btn-primary">Cerca hotel</button>
    </form>


    <!-- array di hotel -->
    <?php
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    ?>

    <!-- stampa degli elementi in pagina -->
    <?php
    foreach ($hotels as $hotel) {

        foreach ($hotel as $key => $value) {

            //condizione per vero/falso
            if ($key === 'parking') {
                $value = $value ? 'Sì' : 'No';
            }
        }
    }
    ?>

    <!-- tabella -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Parcheggio</th>
                <th scope="col">Voto</th>
                <th scope="col">Distanza dal centro</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($hotels as $hotel) {
                // parcheggio
                if ($parking_request) {
                    if (!$hotel['parking']) {
                        // si esce dal ciclo
                        continue;
                    }
                }


            ?>
                <tr>
                    <td><?= $hotel['name'] ?></td>
                    <td><?= $hotel['description'] ?></td>
                    <td><?= $hotel['parking'] ? 'Sì' : 'No' ?></td>
                    <td><?= $hotel['vote'] ?></td>
                    <td><?= $hotel['distance_to_center'] ?> km</td>
                <?php } ?>
        </tbody>
    </table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>