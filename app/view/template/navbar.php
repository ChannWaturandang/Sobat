<nav class="navbar navbar-expand navbar-light bg-tosca mb-3 topbar static-top container_fluid">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas"><img style="width: 60px;" src="<?= APP_PATH; ?>/img/sobat.png" alt=""></i>
        </div>
        <div class="sidebar-brand-text mx-3">SOBAT<sup></sup></div>
    </a>

    <div id="live-datetime">
        <div class="time" id="time"></div>
        <div class="date" id="date"></div>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Topbar Search -->
        <form id="searchForm" class="d-none d-sm-inline-block navbar-search" action="javascript:void(0);" method="post">
            <div class="input-group">
                <input name="keyword" id="keyword" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Notification Icon -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <!-- Add more alert items as needed -->
            </div>
        </li>


        <h5 class="d-lg-block d-none mt-2"><b></b></h5>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
            <!-- Topbar Search -->
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow mt-1">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="<?= APP_PATH; ?>/img/chan.jpg">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-2"><?php echo $_SESSION['name'] . ' ' . $_SESSION['surname'] ?></span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="index.php?page=user">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= APP_PATH; ?>/Login/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
</nav>

<!-- Modal Bootstrap untuk Hasil Pencarian -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Hasil Pencarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="searchResults">
                <!-- Hasil pencarian akan dimasukkan di sini oleh AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="side">
    <!-- Sidebar -->
    <ul class="pr-2 sidebar sidebar-dark accordion col-md-2" id="accordionSidebar">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider w-100">

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa-solid fa-notes-medical"></i>

                <span>Konfigurasi Obat</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded">
                    <a class="collapse-item bg-light" href="<?= APP_PATH; ?>/master/satuan">Satuan</a>
                    <a class="collapse-item bg-light" href="<?= APP_PATH; ?>/master/kategori">Kategori</a>
                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                    <a class="collapse-item" href="<?= APP_PATH; ?>/master/data_obat">Data Obat</a>
                    <a class="collapse-item" href="<?= APP_PATH; ?>/master/data_pegawai">Data pegawai</a>
                    <a class="collapse-item" href="<?= APP_PATH; ?>/master/data_supplier">Data Supplier</a>
                    <!-- <a class="collapse-item" href="<?= APP_PATH; ?>/master/chatbot">Chat Bot</a> -->
                    <!-- <a class="collapse-item" href="index.php?page=user">User</a> -->
                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                <i class="fas fa-fw fa-desktop"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                    <a class="collapse-item" href="<?= APP_PATH; ?>/transaksi/transaksi_jual">Transaksi Jual</a>
                    <a class="collapse-item" href="<?= APP_PATH; ?>/transaksi/transaksi_beli">Transaksi Beli</a>

                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="<?= APP_PATH; ?>/transaksi/laporan">
                <i class="fa-solid fa-scroll"></i>
                <span>Laporan</span>
            </a>
        </li>
        <hr class="sidebar-divider w-100">
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse3">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapse4" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                    <a class="collapse-item" href="<?= APP_PATH; ?>/pengaturan/pengaturan">Profil saya</a>
                    <a class="collapse-item" href="<?= APP_PATH; ?>/pengaturan/chatbot_settings">ChatBot</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider w-100 d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid scroll">

                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item pointer"><a href="<?= APP_PATH; ?>/home/index">Home</a></li>
                        <li class="breadcrumb-item active pointer" aria-current="page"><?= $data['title']; ?></li>
                    </ol>
                </nav>

                <div class="robot-container" type="button" data-bs-toggle="modal" data-bs-target="#chatModal">
                    <img src="<?= APP_PATH; ?>/video/Robot.gif" alt="Robot" class="robot" id="robotPopover" data-bs-toggle="popover" data-bs-content="Hi.. jika kamu butuh bantuan aku siap membantu!" data-bs-trigger="manual">
                </div>

                <!-- Chatbot -->
                <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" id="modal-content-chatbot">
                            <div id="header" class="modal-header">
                                <h5 class="modal-title" id="chatModalLabel">Med-Bot</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="messages"></div>
                                <div class="input-container">
                                    <input type="text" id="promptInput" class="form-control" placeholder="Ask your question here..." oninput="toggleButton()" />
                                    <button class="btn btn-primary" id="sendPromptBtn" onclick="sendPrompt()" disabled>Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#searchForm').submit(function(e) {
                            e.preventDefault();
                            var keyword = $('#keyword').val();

                            // AJAX request
                            $.ajax({
                                url: "<?= APP_PATH ?>/Home/cari",
                                type: "POST",
                                data: {
                                    keyword: keyword
                                },
                                success: function(response) {
                                    var resultHtml = '';

                                    if (response.length > 0) {
                                        resultHtml += '<ul>';
                                        response.forEach(function(row) {
                                            resultHtml += `
                                <li>
                                    <strong>Sumber:</strong> ${row.source || 'Tidak Diketahui'} -
                                    <strong>Kode:</strong> ${row.kode || ''} -
                                    <strong>Nama:</strong> ${row.name || ''}
                                </li>
                            `;
                                        });
                                        resultHtml += '</ul>';
                                    } else {
                                        resultHtml = '<p>Tidak ada hasil untuk kata kunci yang Anda cari.</p>';
                                    }

                                    $('#searchResults').html(resultHtml);
                                    var searchModal = new bootstrap.Modal(document.getElementById("searchModal"));
                                    searchModal.show();
                                },
                                error: function(xhr, status, error) {
                                    $('#searchResults').html('<p>Terjadi kesalahan. Coba lagi nanti.</p>');
                                    var searchModal = new bootstrap.Modal(document.getElementById("searchModal"));
                                    searchModal.show();
                                }
                            });
                        });
                    });
                </script>