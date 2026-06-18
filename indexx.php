<?php

session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

require("functions.php");

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

    // pastikan output array bukan null

    $jumlahDataPerHalaman = 2;
    $cekBuku = query("SELECT * FROM buku");
    $jumlahData = is_array($cekBuku) ? count($cekBuku) : 0;
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
    
    $buku = search_data($keyword, $awalData, $jumlahDataPerHalaman);
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIMBS | Dashboard</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="dist/css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav bg-primary-subtle">
            <li class="nav-item bg=primary-subtle">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block bg-primary-subtle">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block bg-primary-subtle">
              <a href="#Footer" class="nav-link">Contact</a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">

            <!-- Dropdown User -->
          <li class="nav-item dropdown bg-promary-subtle">
              <a class="nav-link d-flex align-items-center bg-primary-subtle" data-bs-toggle="dropdown" href="#" role="button">
                  <!-- Icon profil default -->
                  <i class="bi bi-person-circle fs-4 me-2"></i>
                  <!-- Username tampil di kanan icon -->
                  <span class="fw-bold">
                      <?= htmlspecialchars($_SESSION['username']); ?>
                  </span>
              </a>
              <!-- ISI DROPDOWN -->
              <div class="dropdown-menu dropdown-menu-end p-3" style="width: 250px;">
                  <!-- HEADER DROPDOWN -->
                  <div class="text-center mb-3">
                      <!-- Icon besar -->
                      <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                      <h6 class="mt-2 mb-0"><?= htmlspecialchars($_SESSION['username']); ?></h6>
              </div>
                  <div class="d-grid gap-2">
                      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                  </div>
              </div>
          </li>

              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-primary-subtle shadow" data-bs-theme="primary-subtle">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Galeri Buku</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Data Galeri Buku
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Daftar Buku</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./kategori.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header">AUTENTIKASI</li>
              <li class="nav-item">
                <a href="./logout.php" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Log Out</p>
                </a>
              </li>

            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

      <!-- ====================================================================================== -->
                                          <!--  MAIN SECTION -->
      <!-- ====================================================================================== -->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <!-- <h1>Halo, Selamat Datang 
                  <?= $_SESSION['username'] ?>
                </h1> -->
                <h3 class="mb-3">Kategori</h3>
                <a href="tambah_data2.php">
                  <button class="btn-sm btn btn-primary">Tambah Data</button>
                </a>
              </div>
              <div class="col-sm-6 d-flex flex-column align-items-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                </ol>
                <form class="mt-2">
                  <div class="input-group">
                  <input 
                    type="text" 
                    class="form-control" 
                    name="keyword" 
                    placeholder="Cari produk..."
                  >
                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                  </button>
                </div>
                </form>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col">
              <!-- =============== ISI TABEL ADA DI SINI =============== -->
                <table class="table table-striped table-hover align-middle">
                    <tr>
                         <th>No.</th>
                          <th>ID Buku</th>
                          <th>Judul Buku</th>
                          <th>Deskripsi</th>
                          <th>Nama Penulis</th>
                          <th>Nama Penerbit</th>
                          <th>Tahun Terbit</th>
                          <th>Kategori</th>
                          <th>Gambar</th>
                          <th>Tanggal Input</th>
                          <th>Aksi</th>
                    </tr>
                    <?php $no = 1; ?>
                    <?php foreach ($buku as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_buku']; ?></td>
                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['sinopsis']; ?></td>
                            <td><?= $row['penulis']; ?></td>
                            <td><?= $row['penerbit']; ?></td>
                            <td><?= $row['tahun_terbit']; ?></td>
                            
                            <td><?= $row['n_kategori']; ?></td>
                            <td>
                                <img src="dist/assets/img/<?= $row['gambar']; ?>" width="100" class="img-thumbnail">
                            </td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td>
                                <a href="ubah_data.php?id=<?= $row['id_buku']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="hapus_data.php?id=<?= $row['id_buku']; ?>" 
                                onclick="return confirm('Yakin hapus?')"
                                class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                </table>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <div class="content-wrapper">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active">
                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php else : ?>
              <li class="page-item">
                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>

      <!-- FOOTER START -->
      <footer class="text-center p-3 bg-primary-subtle" id="Footer">
        <div>
          <a href="https://www.instagram.com/nndlizz?igsh=bmVmMTB0c3NjOXlj" class="text-decoration-none text-primary mx-2">
            <i class="h4 bi bi-instagram"></i>
          </a>
          <a href="https://www.facebook.com/share/17avxabXX6/" class="text-decoration-none text-primary mx-2">
            <i class="h4 bi bi-facebook"></i>
          </a>
          <a href="https://www.linkedin.com/in/ananda-aulia-fauziah-649500328?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="text-decoration-none text-primary mx-2">
            <i class="h4 bi bi-linkedin"></i>
          </a>
          <p class="mt-3 mb-0 text-secondary">
            Copyright &copy; <span class="fw-semibold">Ananda Aulia Fauziah</span>
          </p>
        </div>
      </footer>
      <!-- FOOTER END -->
    </div> 
    <!--end::App Wrapper-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
   
  </body>
  <!--end::Body-->
</html>