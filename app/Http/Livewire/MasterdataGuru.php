<?php




namespace App\Http\Livewire;



use Livewire\Component;

use App\Models\Guru;



class MasterdataGuru extends Component

{



public $guru, $nama_guru, $mapel, $is_walikelas, $keterangan, $status;

public $isModal = 0;



//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER

public function render()

{

$this->guru = Guru::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA

return view('livewire.guru'); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER //RESOURSCES/VIEWS/LIVEWIRE

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

$this->nama_guru = '';

$this->is_walikelas = '';

$this->keterangan = '';

$this->status = '';

$this->id_kelas = '';

}



//METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA

public function store()

{

//MEMBUAT VALIDASI

$this→validate([

'nama_guru' => 'required|string',

'is_walikelas' => 'required|email|unique:members,email,' . $this->member_id,

'keterangan' => 'required|numeric',

'status' => 'required',
'id_kelas' => 'required'


]);



//QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE

//DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA

//JIKA TIDAK, MAKA TAMBAHKAN DATA BARU


Member::updateOrCreate(['id' => $this->id_guru], [

'nama_guru' => $this→nama_guru,

'is_walikelas' => $this->is_walikelas,

'keterangan' => $this->keterangan,

'status' => $this→status,
'id_kelas' => $this->id_kelas,

]);



//BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI

session()->flash('message', $this->id_guru ? $this->nama_guru . ' Diperbaharui': $this->nama_guru . ' Ditambahkan');

$this->closeModal(); //TUTUP MODAL

$this->resetFields(); //DAN BERSIHKAN FIELD

}



//FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER

public function edit($id)

{

$member = Member::find($id); //BUAT QUERY UTK PENGAMBILAN DATA

//LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA

$this->id_guru = $id;

$this->nama_guru = $siswa->nama_guru;

$this->is_walikelas = $siswa->is_walikelas;

$this->keterangan = $siswa->keterangan;

$this->status = $member→status;




$this->openModal(); //LALU BUKA MODAL

}



//FUNGSI INI UNTUK MENGHAPUS DATA

public function delete($id)

{

$guru = Guru::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID

$guru->delete(); //LALU HAPUS DATA

session()->flash('message', $guru->nama_guru . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI

}

}
