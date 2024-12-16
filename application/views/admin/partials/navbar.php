<nav class="navbar">
    <div class="navbar-content">
        <div class="logo-mini-wrapper">
            <img src="<?= base_url('public/admin/assets/images/logo-mini-light.png'); ?>"
                class="logo-mini logo-mini-light" alt="Logo Light">
            <img src="<?= base_url('public/admin/assets/images/logo-mini-dark.png'); ?>"
                class="logo-mini logo-mini-dark" alt="Logo Dark">
        </div>
        <ul class="navbar-nav">
            <li class="theme-switcher-wrapper nav-item">
                <input type="checkbox" id="theme-switcher">
                <label for="theme-switcher">
                    <div class="box dark">
                        <div class="ball"></div>
                        <div class="icons">
                            <i class="feather icon-sun"></i>
                            <i class="feather icon-moon"></i>
                        </div>
                    </div>
                </label>
            </li>
            <li class="nav-item dropdown">
                <?php
                $current_language = $this->session->userdata("admin_lang");
                $flags_data = [
                    "az" => [
                        "url" => base_url("public/admin/assets/images/flags/az.svg"),
                        "lang" => "Azərbaycan"
                    ],
                    "en" => [
                        "url" => base_url("public/admin/assets/images/flags/us.svg"),
                        "lang" => "English"
                    ],
                    "ru" => [
                        "url" => base_url("public/admin/assets/images/flags/ru.svg"),
                        "lang" => "Русский"
                    ],
                ];
                ?>
                <a class="nav-link dropdown-toggle d-flex" href="javascript:void(0);" id="languageDropdown"
                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= $flags_data[$current_language]["url"]; ?>" class="w-20px" alt="Flag">
                    <span class="ms-2 d-none d-md-inline-block">
                        <?= $flags_data[$current_language]["lang"]; ?>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <?php foreach ($flags_data as $lang_code => $flag_data): ?>
                        <a href="<?= base_url('admin/lang/switch/' . $lang_code); ?>"
                            class="dropdown-item py-2 d-flex <?= $current_language == $lang_code ? 'disabled' : '' ?>">
                            <img src="<?= $flag_data["url"]; ?>" class="w-20px" alt="<?= strtoupper($lang_code); ?>">
                            <span class="ms-2"><?= $flag_data["lang"] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>




















            
            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="profileDropdown" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="w-30px h-30px ms-1 rounded-circle"
            src="<?= base_url('public/admin/assets/images/faces/' . ($this->session->userdata('username') ?? 'default.jpg')); ?>" alt="Profile">
    </a>
    <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
                <img class="w-80px h-80px rounded-circle"
                    src="<?= base_url('public/admin/assets/images/faces/' . ($this->session->userdata('username') ?? 'default.jpg')); ?>" alt="Profile">
            </div>
            <div class="text-center">
                <p class="fs-16px fw-bolder"><?= $this->session->userdata('username'); ?></p>
                <p class="fs-12px text-secondary"><?= $this->session->userdata('email'); ?></p>
                <p class="fs-12px text-warning"><?= ucfirst($this->session->userdata('role')); ?></p>
            </div>
        </div>
        <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
                <a href="<?= base_url('admin/profiles/' . $this->session->userdata('user_id')); ?>" class="text-body ms-0">
                    <i class="me-2 icon-md" data-feather="user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="dropdown-item py-2">
                <a href="<?= base_url('admin/profiles/' . $this->session->userdata('user_id') . '/edit'); ?>" class="text-body ms-0">
                    <i class="me-2 icon-md" data-feather="edit"></i>
                    <span>Edit Profile</span>
                </a>
            </li>
            <li class="dropdown-item py-2">
                <a href="<?= base_url('admin/profiles/logout'); ?>" class="text-body ms-0">
                    <i class="me-2 icon-md text-danger" data-feather="log-out"></i>
                    <span class="fw-bold text-danger">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</li>

        </ul>
        <a href="javascript:void(0);" class="sidebar-toggler">
            <i data-feather="menu"></i>
        </a>
    </div>
</nav>