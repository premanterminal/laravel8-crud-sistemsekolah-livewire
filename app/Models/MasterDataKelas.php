<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataKelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'id_wali_kelas', 'status', 'keterangan'];
    //protected $guarded = [];
}
