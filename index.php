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

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <title>php-hotels</title>
    </head>

    <body>

        <!-- controllo filtri -->
        <?php

        // parcheggio
        $parking_request = false;

        if (isset($_GET['parking']) && $_GET['parking'] == "on") {

            $parking_request = true;
        }
        var_dump($parking_request);

        // voto

        $selectedVotes = 0;

        if (isset($_GET['vote']) && is_array($_GET['vote'])) {

            $selectedVotes = array_map('intval', $_GET['vote']); // intval: sicurezza valori non numerici)
        }
        ?>


        <h1>Hotel PHP</h1>

        <!-- form filtro -->
        <form action="" class="container mt-5 p-4 border rounded bg-light shadow-sm">
            <div class="mb-4 form-control">
                <h5 class="mb-2">Voto medio hotel?</h5>
                <div class="d-flex flex-wrap gap-3">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <div class="form-check form-check-inline">
                            <!-- verifica che il form sia stato inviato con almeno un voto selezionato e che il valore corrente $i sia presente nell'array $_GET['vote'] inviato dal form. Se entrambe le condizioni sono vere, stampa "checked" (seleziona la checkbox); altrimenti stampa una stringa vuota ('') -->
                            <input class="form-check-input" type="checkbox" id="vote<?= $i ?>" name="vote[]" value="<?= $i ?>" <?= (isset($_GET['vote']) && in_array($i, $_GET['vote'])) ? 'checked' : '' ?>>
                            <!-- name="vote[] indica che vote fa parte di un array e, mentre php lo legge come $_GET['vote'] = ['2'], il browser lo codifica in vote%5B%5D=2, che è il valore che avremo nell'URL -->
                            <label class="form-check-label" for="vote<?= $i ?>"><?= $i ?></label>
                        </div>
                    <?php }
                    var_dump($i);
                    ?>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-control">
                    <input class="form-check-input" type="checkbox" id="parking" name="parking" <?= $parking_request ? 'checked' : '' ?>>
                    <label class="form-check-label" for="parking">
                        Parcheggio incluso
                    </label>
                </div>
            </div>
            <button class="btn btn-primary">Cerca hotel</button>
        </form>

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

                <!-- filtri funzionanti -->
                <?php

                foreach ($hotels as $hotel) {
                    // parcheggio
                    if ($parking_request) {
                        if (!$hotel['parking']) {
                            // si esce dal ciclo
                            continue;
                        }
                    }

                    // voto
                    if ($selectedVotes) {
                        if (!in_array($hotel['vote'], $selectedVotes)) {
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