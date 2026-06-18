<?php

// associative array
$data_mahasiswa = [
    [
        "nim" => "240101",
        "nama" => "Andi Pratama",
        "email" => "andi.pratama@example.com",
        "jurusan" => "Teknik Informatika",
        "gambar" => "andi.jpg"
    ],
    [
        "nim" => "240102",
        "nama" => "Budi Santoso",
        "email" => "budi.santoso@example.com",
        "jurusan" => "Sistem Informasi",
        "gambar" => "budi.jpg"
    ],
    [
        "nim" => "240103",
        "nama" => "Citra Lestari",
        "email" => "citra.lestari@example.com",
        "jurusan" => "MKB",
        "gambar" => "citra.jpg"
    ]
];
    require("function.php");

    $query = query("SELECT * FROM mahasiswa");
    $mahasiswa = $query;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi PHP MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-light white bg-danger">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIAK UPI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Link</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <!-- CONTENT SECTION START -->
    <section class="p-3">
        <div class="container">

            <h1>Data Mahasiswa</h1>
             <a href="tambah_data.php">
                <button class="mb-3 btn-sm btn-primary">Tambah Data</button>
            </a>
            <table class="table table-striped table-hover">
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1; ?>
                <?php foreach($mahasiswa as $mhs): ?>
                <tr>
                    <td> <?= $no; ?> </td>
                    <td> <?= $mhs['nim'] ?> </td>
                    <td> <?= $mhs['nama'] ?> </td>
                    <td> <?= $mhs['email'] ?> </td>
                    <td> <?= $mhs['jurusan'] ?> </td>
                    <td> <?= $mhs['gambar'] ?> </td>
                    <td>
                        <a href="ubah_data.php?id=<?= $mhs['id'] ?>&nim=<?= $mhs['nim'] ?>&nama=<?= $mhs['nama'] ?>&email=<?= $mhs['email'] ?>&jurusan=<?= $mhs['jurusan'] ?>&gambar=<?= $mhs['gambar'] ?>">
                            <button class="btn-sm btn-success">Edit</button>
                        </a>
                        <a href="hapus_data.php?id=<?= $mhs['id'] ?>">
                            <button class="btn-sm btn-danger">Hapus</button>
                        </a>

                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </section>
    <!-- CONTENT SECTION END -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>