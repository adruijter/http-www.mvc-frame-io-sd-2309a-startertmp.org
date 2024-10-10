<?php require_once APPROOT . '/views/includes/header.php'; ?>



<!-- Maak een nieuwe view aan voor deze link -->
<div class="container">
    <div class="row mt-3" style='<?= $data['messageVisibility']; ?>'>
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <div class="alert alert-<?= $data['messageColor']; ?>" role="alert">
                    <?= $data['message']; ?>
                </div>
            </div>
            <div class="col-2"></div>
   </div>

    <div class="row mt-3">
        <div class="col-2"></div>
        <div class="col-8">
            <h3><?= $data['title']; ?></h3>
            <p><a href="<?= URLROOT; ?>/Countries/create">Nieuw land toevoegen</a></p>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Hoofdstad</th>
                        <th>Continent</th>
                        <th>Aantal Inwoners</th>
                        <th>Postcode</th>
                        <th>Wijzig</th>
                        <th>Verwijder</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_null($data['dataRows'])) { ?>
                        <tr>
                            <td class='text-center' colspan='7'>Er zijn geen landen bekent</td>
                        </tr>                    
                    <?php } else {
                                    foreach ($data['dataRows'] as $country) { ?>
                                    <tr>
                                        <td><?= $country->Name ?></td>
                                        <td><?= $country->CapitalCity ?></td>
                                        <td><?= $country->Continent ?></td>
                                        <td><?= number_format($country->Population, 0, ",", ".") ?></td>
                                        <td><?= $country->Zipcode ?></td>
                                        <td class='text-center'>
                                            <a href='<?= URLROOT  ?>/countries/update/<?= $country->Id ?>'>
                                                <i class='bi bi-pencil-square'></i>
                                            </a>
                                        </td>
                                        <td class='text-center'>
                                            <a href='<?= URLROOT ?>/countries/delete/<?= $country->Id ?>'>
                                                <i class='bi bi-trash'></i>
                                            </a>
                                        </td>            
                                    </tr>
                                <?php }} ?>
                </tbody>
            </table>
            <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>