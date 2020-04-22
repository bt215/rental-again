<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    protected $table="peminjam";
  protected $primaryKey="id";
  protected $fillable=['nama_peminjam','nik','foto','alamat','no_telp'];
  public $timestamps=false;
}
