<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    protected $table = 'tb_pegawai';
    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';
    protected $fillable = ['*'];
    use HasFactory;
}
