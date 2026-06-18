<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "siak_upi");

function query($query) {
 global $conn;
 $result = mysqli_query($conn, $query);
 $rows = [];
 while( $row = mysqli_fetch_assoc($result) ) {
     $rows[] = $row;
 }
 return $rows;
}

// fungsi untuk menambahkan data
function tambah_data($data){
    global $conn;

    // var_dump($data);
    // die;

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $gambar = $_POST['gambar'];

    $query = "INSERT INTO mahasiswa (nim, nama, email, jurusan, gambar)
              VALUES ('$nim', '$nama', '$email', '$jurusan', '$gambar')
             ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_data($id){
    global $conn;

    $query = "DELETE FROM mahasiswa WHERE id = $id";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_data($data){
    global $conn;


    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $gambar = $_POST['gambar'];


    // var_dump($data);
    // die;


    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
              WHERE id = $id
             ";


    $result = mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
     
}

?>