<div class="container-fluid">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= $_SESSION['image'] ?>" alt="Admin" class="rounded-circle p-1 bg-primary pointer" width="110" onclick="openImageModal()" style="cursor: pointer;">

                            <div class="mt-3">
                                <h4><?= $_SESSION['name'] . ' ' . $_SESSION['surname'] ?> </h4>
                                <p class="text-secondary mb-1"><?php
                                    if (isset($_SESSION['user_id'])){
                                        echo "Online";
                                    }
                                ?></p>
                                <!-- <p class="text-muted font-size-sm"><?= $_SESSION['role']?></p> -->
                                
                            </div>
                        </div>
                        <hr class="my-4">

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= APP_PATH;?>/Home/changePicture"></form>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="text-small">NAMA LENGKAP</h6>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $_SESSION['name'].' '.$_SESSION['surname']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="text-small">EMAIL</h6>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $_SESSION['email']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="text-small">NOMOR TELEPON</h6>
                            </div>
                            <div class="col-md-9 text-secondary text-small">
                                <input type="text" class="form-control" value="<?= $_SESSION['phone_number']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="text-small">ROLE</h6>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $_SESSION['role']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="text-small">ALAMAT</h6>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <input type="text" class="form-control" value="Jl. Pasar Sukur">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 text-secondary">
                                <input type="button" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Lihat dan Ganti Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Tampilkan Gambar Besar -->
                    <img src="<?= $_SESSION['image'] ?>" alt="Admin" class="img-fluid" id="largeImage" style="max-width: 100%; border-radius: 10px;">

                    <!-- Form untuk Mengganti Gambar -->
                    <form action="<?= APP_PATH;?>/Home/changePicture" method="post" enctype="multipart/form-data" class="mt-3">
                        <input type="file" name="new_image" accept="image/*" required>
                        <button type="submit" class="btn btn-primary mt-2">Ganti Gambar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .me-2 {
            margin-right: .5rem !important;
        }
    </style>

    <script>
        // Fungsi untuk membuka modal saat gambar diklik
        function openImageModal() {
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'), {});
            imageModal.show();
        }
    </script>