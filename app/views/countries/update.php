<?php require_once APPROOT . '/views/includes/header.php'; ?>

    <div class="container">
  
        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <h3><?= $data['title']; ?></h3>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row mt-3">
            <div class="col-3">
            </div>
            <div class="col-6">
                <form action="<?= URLROOT; ?>/countries/update/<?= $data['Id']; ?>" method="post">
                    <div class="mb-3">
                        <label for="inputNameCountry" class="form-label">Land:</label>
                        <input value="<?= $data['country']; ?>" name="country" type="text" class="form-control" id="inputNameCountry" placeholder="Vul hier de naam van het land in">
                    </div>

                    <div class="mb-3">
                        <label for="inputNameCapitalCity" class="form-label">Hoofdstad:</label>
                        <input value="<?= $data['capitalCity']; ?>" name="capitalCity" type="text" class="form-control" id="inputNameCapitalCity" placeholder="Vul hier de naam van de hoofdstad in">
                    </div>

                    <div class="mb-3">
                        <label for="inputNameContinent" class="form-label">Continent:</label>
                        <input value="<?= $data['continent']; ?>" name="continent" type="text" class="form-control" id="inputNameContinent" placeholder="Vul hier de naam van het continent in">
                    </div>

                    <div class="mb-3">
                        <label for="inputPopulation" class="form-label">Aantal inwoners:</label>
                        <input value="<?= $data['population']; ?>" name="population" type="text" class="form-control" id="inputPolulation" placeholder="Vul hier het aantal mensen in woonachtig in het land">
                    </div>

                    <div class="mb-3">
                        <label for="inputNameZipcode" class="form-label">Postcode:</label>
                        <input value="<?= $data['zipcode']; ?>" name="zipcode" type="text" class="form-control" id="inputNameZipcode" placeholder="Vul hier uw Nederlandse postcode in">
                    </div>

                    <input type="hidden" name="Id" value="<?= $data['Id']; ?>">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Sla op</button>
                    </div>
                </form>
            </div>
            <div class="col-3">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>        
            </div>
            <div class="col-3"></div>
        </div>
        </div>

 <?php require_once APPROOT . '/views/includes/footer.php'; ?>
?>