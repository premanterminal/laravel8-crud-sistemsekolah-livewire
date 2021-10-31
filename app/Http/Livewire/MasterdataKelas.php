<?php


namespace App\Http\Livewire;



use Livewire\Component;

use App\Models\Kelas;



class MasterdataKelas extends Component

{



public $kelas, $nama_kelas, $id_guru,  $keterangan, $status;

public $isModal = 0;



//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER

public function render()

{

$this->kelas = Kelas::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA

return view('livewire.kelas'); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER //RESOURSCES/VIEWS/LIVEWIRE

}



//FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN

public function create()

{

//KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD

$this->resetFields();

//DAN MEMBUKA MODAL

$this->openModal();

}



//FUNGSI INI UNTUK MENUTUP MODAL DIMANA VARIABLE ISMODAL KITA SET JADI FALSE

public function closeModal()

{

$this->isModal = false;

}



//FUNGSI INI DIGUNAKAN UNTUK MEMBUKA MODAL

public function openModal()

{

$this->isModal = true;

}



//FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI

public function resetFields()

{

$this->nama_kelas = '';

$this->id_guru = '';

$this->keterangan = '';

$this->status = '';



}



//METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA

public function store()

{

//MEMBUAT VALIDASI

$this→validate([

'nama_kelas' => 'required|string',

'id_guru' => 'required',

'keterangan' => 'required|numeric',

'status' => 'required',


]);



//QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE

//DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA

//JIKA TIDAK, MAKA TAMBAHKAN DATA BARU


Kelas::updateOrCreate(['id' => $this->id_kelas], [

'nama_kelas' => $this→nama_kelas,

'id_guru' => $this->id_guru,

'keterangan' => $this->keterangan,

'status' => $this→status,


]);



//BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI

session()->flash('message', $this->id_kelas ? $this->nama_kelas . ' Diperbaharui': $this->nama_kelas . ' Ditambahkan');

$this->closeModal(); //TUTUP MODAL

$this->resetFields(); //DAN BERSIHKAN FIELD

}



//FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER

public function edit($id)

{

$kelas = Kelas::find($id); //BUAT QUERY UTK PENGAMBILAN DATA

//LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA


$this->id_kelas = $id;

$this->nama_kelas = $siswa->nama_kelas;

$this->id_guru = $siswa->id_guru;

$this->keterangan = $siswa->keterangan;

$this->status = $member→status;




$this->openModal(); //LALU BUKA MODAL

}



//FUNGSI INI UNTUK MENGHAPUS DATA

public function delete($id)

{

$kelas = Kelas::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID

$kelas->delete(); //LALU HAPUS DATA

session()->flash('message', $kelas->nama_kelas . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI

}

}
