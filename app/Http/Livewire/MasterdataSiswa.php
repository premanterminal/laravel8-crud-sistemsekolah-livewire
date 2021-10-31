<?php




namespace App\Http\Livewire;



use Livewire\Component;

use App\Models\Siswa;



class MasterdataSiswa extends Component

{



public $siswa, $nama_siswa, $kelas, $keterangan, $status, $id_kelas;

public $isModal = 0;



//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER

public function render()

{

$this->siswa = Siswa::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA

return view('livewire.siswa'); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER //RESOURSCES/VIEWS/LIVEWIRE

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


$this->nama_siswa = '';

$this->kelas = '';

$this->keterangan = '';

$this->status = '';

$this->id_kelas = '';

}



//METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA

public function store()

{

//MEMBUAT VALIDASI

$this→validate([
 

'nama_siswa' => 'required|string',

'kelas' => 'required',

'keterangan' => 'required|numeric',

'status' => 'required',
'id_kelas' => 'required'


]);



//QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE

//DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA

//JIKA TIDAK, MAKA TAMBAHKAN DATA BARU


Siswa::updateOrCreate(['id' => $this->id_siswa], [

'nama_siswa' => $this→nama_siswa,

'kelas' => $this->kelas,

'keterangan' => $this->keterangan,

'status' => $this→status,
'id_kelas' => $this->id_kelas,

]);



//BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI

session()->flash('message', $this->id_siswa ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');

$this->closeModal(); //TUTUP MODAL

$this->resetFields(); //DAN BERSIHKAN FIELD

}



//FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER

public function edit($id)

{

$siswa = Siswa::find($id); //BUAT QUERY UTK PENGAMBILAN DATA

//LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA

$this->id_siswa = $id;

$this->nama_siswa = $siswa->nama_siswa;

$this->kelas = $siswa->kelas;

$this->keterangan = $siswa->keterangan;

$this->status = $siswa→status;
$this->id_kelas = $siswa->id_kelas;



$this->openModal(); //LALU BUKA MODAL

}



//FUNGSI INI UNTUK MENGHAPUS DATA

public function delete($id)

{

$siswa = Siswa::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID

$siswa->delete(); //LALU HAPUS DATA

session()->flash('message', $siswa->nama_siswa . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI

}

}
