<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataGuru extends Model
{
    use HasFactory;

    protected $fillable = ['nama_guru', 'id_mapel', 'id_kelas', 'status', 'keterangan'];
    //protected $guarded = [];
}
