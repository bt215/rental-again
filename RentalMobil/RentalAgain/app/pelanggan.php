<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
  protected $table="pelanggan";
  protected $primaryKey="id";
  protected $fillable=['nama','no_telp','alamat'];
  public $timestamps=false;
}
