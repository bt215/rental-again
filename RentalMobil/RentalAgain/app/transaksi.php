<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table="transaksi";
    protected $primaryKey="id";
    protected $fillable=['id_petugas','id_pelanggan','tgl_transaksi','tgl_selesai'];
    public $timestamps=false;
}
