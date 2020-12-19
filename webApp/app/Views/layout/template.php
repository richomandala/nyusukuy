<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?> | Nyusukuy</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/font-awesome/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/select2/css/select2.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">

    <!-- Page CSS -->
    <?php
    if (isset($customCSS)) :
        foreach ($customCSS as $css) :
    ?>
            <link rel="stylesheet" href="/css/page/<?= $css; ?>">
    <?php
        endforeach;
    endif;
    ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="/img/milk.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= getUser()['nama']; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a id="logout" href="/auth/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/">
                            <img src="/img/logo.png" alt="logo" style="width: 50px;">
                            Nyusukuy
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/"><img src="/img/logo.png" alt="logo" style="width: 50px;"></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu</li>
                        <li <?= ($menu == 'home') ? 'class="active"' : '' ?>><a class="nav-link" href="/"><i class="fas fa-fw fa-home"></i> <span>Home</span></a></li>
                        <?php if (getUser()['role_id'] == 1) { ?>
                            <li class="dropdown <?= ($menu == 'produk' || $menu == 'bahan') ? 'active' : '' ?>">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-list-alt"></i><span>Produk</span></a>
                                <ul class="dropdown-menu">
                                    <li <?= ($menu == 'produk') ? 'class="active"' : '' ?>><a class="nav-link" href="/produk">Produk jadi</a></li>
                                    <li <?= ($menu == 'bahan') ? 'class="active"' : '' ?>><a class="nav-link" href="/bahan">Bahan mentah</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?= ($menu == 'penjualan' || $menu == 'pembelian') ? 'active' : '' ?>">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-shopping-cart"></i><span>Transaksi</span></a>
                                <ul class="dropdown-menu">
                                    <li <?= ($menu == 'penjualan') ? 'class="active"' : '' ?>><a class="nav-link" href="/penjualan">Penjualan</a></li>
                                    <li <?= ($menu == 'pembelian') ? 'class="active"' : '' ?>><a class="nav-link" href="/pembelian">Pembelian</a></li>
                                </ul>
                            </li>
                            <li <?= ($menu == 'inventaris') ? 'class="active"' : '' ?>><a class="nav-link" href="/inventaris"><i class="fas fa-fw fa-briefcase"></i> <span>Inventaris</span></a></li>
                            <li <?= ($menu == 'supplier') ? 'class="active"' : '' ?>><a class="nav-link" href="/supplier"><i class="fas fa-fw fa-truck"></i> <span>Supplier</span></a></li>
                        <?php } else if (getUser()['role_id'] == 2) { ?>
                            <li <?= ($menu == 'penjualan') ? 'class="active"' : '' ?>><a class="nav-link" href="/penjualan"><i class="fas fa-fw fa-shopping-cart"></i> <span>Penjualan</span></a></li>
                        <?php } ?>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $title; ?></h1>
                        <div class="section-header-breadcrumb">
                            <?php foreach ($breadcumb as $bc) : ?>
                                <div class="breadcrumb-item"><?= $bc; ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="section-body">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </section>
            </div>

            <?= $this->renderSection('addition'); ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2020 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                    <div class="bullet"></div> Developed by <a href="https://github.com/richomandala">Richo Mandala</a>
                    <div class="bullet"></div> Elapsed time in {elapsed_time} seconds
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="/assets/popper/popper.min.js"></script>
    <script src="/assets/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/moment/moment.min.js"></script>
    <script src="/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="/assets/select2/js/select2.min.js"></script>

    <!-- Template JS File -->
    <script src="/js/scripts.js"></script>
    <script src="/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <?php
    if (isset($customJS)) :
        foreach ($customJS as $js) :
    ?>
            <script src="/js/page/<?= $js; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</body>

</html>