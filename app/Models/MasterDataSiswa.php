<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataSiswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama_siswa', 'id_kelas', 'status', 'keterangan'];
    //protected $guarded = [];
}
