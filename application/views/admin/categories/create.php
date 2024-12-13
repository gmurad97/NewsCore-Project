<?php $this->load->view("admin/partials/head"); ?>
<?php $this->load->view("admin/partials/sidebar"); ?>
<?php $this->load->view("admin/partials/navbar"); ?>
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create Category</h6>
                    <?php $alert = $this->session->flashdata("category_create_alert"); ?>
                    <?php if ($alert): ?>
                        <div class="alert <?= $alert['alert_class']; ?> alert-dismissible fade show" role="alert">
                            <i data-feather="<?= $alert['alert_icon']; ?>"></i>
                            <strong><?= $alert['alert_message']['title'] ?></strong>
                            <?= $alert['alert_message']['description'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/categories/store'); ?>" method="POST"
                        enctype="application/x-www-form-urlencoded">
                        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="az-line-tab" data-bs-toggle="tab" href="#az" role="tab"
                                    aria-controls="az" aria-selected="true">
                                    AZ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="en-line-tab" data-bs-toggle="tab" href="#en" role="tab"
                                    aria-controls="en" aria-selected="true">
                                    EN
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="ru-line-tab" data-bs-toggle="tab" href="#ru" role="tab"
                                    aria-controls="ru" aria-selected="true">
                                    RU
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="lineTabContent">
                            <div class="tab-pane fade show active" id="az" role="tabpanel"
                                aria-labelledby="az-line-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="category_name_az" class="form-label">Category name</label>
                                            <input name="category_name_az" maxlength="255" type="text"
                                                class="form-control" placeholder="Siyasət" id="category_name_az">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-line-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="category_name_en" class="form-label">Category name</label>
                                            <input name="category_name_en" maxlength="255" type="text"
                                                class="form-control" placeholder="Politics" id="category_name_en">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru-line-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="category_name_ru" class="form-label">Category name</label>
                                            <input name="category_name_ru" maxlength="255" type="text"
                                                class="form-control" placeholder="Политика" id="category_name_ru">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2">
                                    <input name="category_status" type="checkbox" class="form-check-input"
                                        id="categoryStatus" checked>
                                    <label class="form-check-label" for="categoryStatus">Status</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/partials/footer"); ?>
<?php $this->load->view("admin/partials/scripts"); ?>