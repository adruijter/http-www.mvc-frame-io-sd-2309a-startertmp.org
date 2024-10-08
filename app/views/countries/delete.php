<?php require_once APPROOT . '/views/includes/header.php'; ?>   

<div class="container mt-3">
    <div class="row mt-3 text-center" style='<?= $data['messageVisibility']; ?>'>
        <div class="col-3"></div>
        <div class="col-6">
            <div class="alert alert-<?= $data['messageColor']; ?>" role="alert">
                <?= $data['message']; ?>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>