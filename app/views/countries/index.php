<?php require_once APPROOT . '/views/includes/header.php'; ?>



<!-- Maak een nieuwe view aan voor deze link -->
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3><?= $data['title']; ?></h3>
            <p><a href="<?= URLROOT; ?>/Countries/create">Nieuw land toevoegen</a></p>
        </div>
        <div class="col-3"></div>
    </div>


    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Hoofdstad</th>
                        <th>Continent</th>
                        <th>Aantal Inwoners</th>
                        <th>Wijzig</th>
                        <th>Verwijder</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $data['dataRows']; ?>
                </tbody>
            </table>
            <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>