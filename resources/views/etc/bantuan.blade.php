@extends('app', ['titlePage' => 'BANTUAN'])
@section('content')
    <p>Pada Halaman Pencarian Pengguna dapat memilih untuk mencari hadis berdasarkan kata ataupun berdasarkan kategori</p>
    <p><strong>Untuk Pencarian Berdasarkan Kata :</strong></p>
    <ul>
        <li>Pengguna memasukkan kata kunci mulai dari satu hingga maksimal empat kata pada kolom masukkan kata kunci</li>
        <li>Pengguna mengisi check box Kitab Hadis yang diinginkan</li>
        <li>Pengguna menekan tombol OK</li>
    </ul>
    <p><strong>Untuk Pencarian Berdasarkan Kategori :</strong></p>
    <ul>
        <li>Pengguna memasukkan kata pada kolom masukkan kategori</li>
        <li>Pengguna menekan tombol Cari</li>
    </ul>
    <p>Setelah hasil pencarian ditampilkan, Pengguna dapat melihat isi detail hadis dengan menekan Hadis yang diinginkan.</p>
@endsection