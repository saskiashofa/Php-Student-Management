<?php 

// koneksi ke database
// var conn = fungsi koneksi("nama_host", "username", "password", "nama_db"); 
// cara cek username di db mysql dengan CMD --> select user();
$conn = mysqli_connect("localhost", "root", "", "simbs");

// ambil data
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// tambah data
function tambah_data($data){
    global $conn;

    $judul_buku      = $data['judul_buku'];
    $deskripsi       = $data['deskripsi'];
    $nama_penulis    = $data['nama_penulis'];
    $nama_penerbit   = $data['nama_penerbit'];
    $tahun_terbit    = $data['tahun_terbit'];
    $kategori        = $data["id_kategori"];

    $gambar = upload_gambar($judul_buku);  
    if( !$gambar ) {
        return false;
    }
    $query = "INSERT INTO buku 
                (judul_buku, deskripsi, nama_penulis, nama_penerbit, tahun_terbit, id_kategori, gambar)
              VALUES 
                ('$judul_buku', '$deskripsi','$nama_penulis', '$nama_penerbit', '$tahun_terbit', '$kategori', '$gambar')
             ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// tambah data kategori
function tambah_data2($data){
    global $conn;

    $nama_kategori   = $data['nama_kategori'];
  
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// fungsi ubah data
function ubah_data($data){
    global $conn;

    $id         = $data['id_buku'];
    $judul      = $data['judul_buku'];
    $deskripsi  = $data['deskripsi'];
    $nama       = $data['nama_penulis'];
    $penerbit   = $data['nama_penerbit'];
    $tahun      = $data['tahun_terbit'];
    $kategori   = $data['id_kategori'];
    $gambarLama = $data['gambarLama'];
    $folder = 'dist/assets/img/';

    // apakah user upload gambar baru?
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {

        // upload gambar baru
        $gambar = upload_gambar($judul);
        if(!$gambar){
            return false;
        }

        // hapus gambar lama
        if(file_exists($folder . $gambarLama)){
            unlink($folder . $gambarLama);
        }
    }

    $query = "UPDATE buku SET
                judul_buku    = '$judul',
                deskripsi     = '$deskripsi',
                nama_penulis  = '$nama',
                nama_penerbit = '$penerbit',
                tahun_terbit  = '$tahun',
                id_kategori = '$kategori',
                gambar        = '$gambar'
              WHERE id_buku = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi ubah data di kategori
function ubah_data2($data){
    global $conn;

    $id        = $data['id_kategori'];
    $kategori  = $data['nama_kategori'];

    $query = "UPDATE kategori SET
                nama_kategori    = '$kategori'
              WHERE id_kategori = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi hapus data
function hapus_data($id){
    global $conn;

    $query = "DELETE FROM buku WHERE id_buku = $id";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi hapus data
function hapus_data2($id){
    global $conn;

    $query = "DELETE FROM kategori WHERE id_kategori = $id";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi untuk mencari data
function search_data($keyword, $awalData, $jumlahDataPerHalaman){
    global $conn;

    if ($keyword != "") {
        $query = "SELECT buku.*, kategori.n_kategori 
                  FROM buku 
                  JOIN kategori ON kategori.id_kategori = buku.id_kategori
                  WHERE judul LIKE '%$keyword%'
                  OR sinopsis LIKE '%$keyword%'
                  OR nama_penulis LIKE '%$keyword%'
                  OR nama_penerbit LIKE '%$keyword%'
                  OR tahun_terbit LIKE '%$keyword%'
                  ORDER BY id_buku DESC
                  LIMIT $awalData, $jumlahDataPerHalaman";
    } else {
        $query = "SELECT buku.*, kategori.n_kategori 
                  FROM buku 
                  JOIN kategori ON kategori.id_kategori = buku.id_kategori
                  ORDER BY id_buku DESC
                  LIMIT $awalData, $jumlahDataPerHalaman";
    }

    return query($query);
}


// fungsi untuk mencari data
function search_data2($keyword){
    global $conn;

    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM kategori WHERE nama_kategori LIKE '%$keyword%' ORDER BY id_kategori DESC";
    return query($query);
}

// fungsi untuk upload gambar
function upload_gambar($judul_buku) {

    // setting gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }


    // cek jika ukurannya terlalu besar
    // maks --> 2MB
    if( $ukuranFile > 2000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }


    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $judul_buku;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'dist/assets/img/' . $namaFileBaru);


    return $namaFileBaru;
}

// fungsi untuk registrasi user
    function register($data_register){
    global $conn;
    // global conn biar bisa akses variabel con di luar fungsi, bisa juga agar koneksi ke database
    // kita tampung dulu data-data yang dikirimkan dari file register.php melalui $data_register ke dalam variabel
   
    $username = strtolower($data_register['username']);
    $email = $data_register['email'];
    $password = mysqli_real_escape_string($conn, $data_register['password']);
    // strlower biar hurufnya otomatis kecil semua, mysqli_real_escape biar simbol seperti titik koma di password ga merusak query sql

    // cek username sudah ada atau belum
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    $result = mysqli_fetch_assoc($query);
    // arrasy ditampilkan dalam bentuk assosiativ (fetch_assoc)

    if($result != NULL){
        return "Username sudah terdaftar di database!";
    } 

    if(strlen($password) < 8 ){
        return "Password minimal 8 karakter!";
    }

    // enkripsi password menggunakan hash, hash itu biar ga tertampil di databes (demi keamana)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (id, username, email, password) VALUES('', '$username', '$email', '$password')");
   
    return true;
}

// fungsi login
function login($data){
    global $conn;
    // session_start();
    // Session = tempat penyimpanan data sementara di server yang dipakai untuk mengidentifikasi user yang sedang aktif di website, selama belom log out server masih menegnali 

    $username = $data['username'];
    $password = $data['password'];

    // cek username sudah ada atau belum
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // var_dump($result);
    // die;

     // Cek user ada atau tidak
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        // var_dump($row);
        // die;

        // echo $row['password'];
        // die;

        // Verify password
        if(password_verify($password, $row["password"])) {
            // echo "masuk sini";
            // die;
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            return true;
        } else {
            // echo "tidak masuk";
            // die;
            return "Password salah!";
        }

    } else {
        return "Username tidak ditemukan!"; // username tidak ditemukan
    }
   
}

?>