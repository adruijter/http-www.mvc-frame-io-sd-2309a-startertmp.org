<?php require_once APPROOT . '/views/includes/header.php'; ?>


<!-- Maak een formulier om gegevens in de Country tabel te kunnen opslaan -->

<div class="container">
  <div class="row mt-3" style='<?= $data['visibility']; ?>'>
        <div class="col-3"></div>
        <div class="col-6">
            <div class="alert alert-<?= $data['messageColor']; ?>" role="alert">
                <?= $data['message']; ?>
            </div>
        </div>
        <div class="col-3"></div>
   </div>



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
        <form action="<?= URLROOT; ?>/countries/create" method="post">
            <div class="mb-3">
                <label for="inputNameCountry" class="form-label">Land:</label>
                <input name="country" type="text" class="form-control" id="inputNameCountry" placeholder="Vul hier de naam van het land in" value="<?= $data['country']; ?>">
            
                <div class="error">
                    <?php if (isset($data['countryError'])) { echo $data['countryError']; } ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputNameCapitalCity" class="form-label">Hoofdstad:</label>
                <input name="capitalCity" type="text" class="form-control" id="inputNameCapitalCity" placeholder="Vul hier de naam van de hoofdstad in" value="<?= $data['capitalCity']; ?>" >
            </div>

            <div class="mb-3">
                <label for="inputNameContinent" class="form-label">Continent:</label>
                <input name="continent" type="text" class="form-control" id="inputNameContinent" placeholder="Vul hier de naam van het continent in" value="<?= $data['continent']; ?>">
            </div>

            <div class="mb-3">
                <label for="inputPopulation" class="form-label">Aantal inwoners:</label>
                <input name="population" type="text" class="form-control" id="inputPolulation" placeholder="Vul hier het aantal mensen in woonachtig in het land" value="<?= $data['population']; ?>">
            </div>

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