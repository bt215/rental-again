<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    protected $table="detail";
    protected $primaryKey="id";
    protected $fillable=['subtotal','harga_kilo','id_transaksi','id_jenis' ,'subtotal','qty' ];
}
