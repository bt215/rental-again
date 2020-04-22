<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datamobil extends Model
{
    protected $table="datamobil";
  protected $primaryKey="id";
  protected $fillable=['nama_mobil','tahun_mobil','plat_nomor','kondisi'];
  public $timestamps=false;
}
