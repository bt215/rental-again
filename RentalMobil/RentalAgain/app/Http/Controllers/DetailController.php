<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use App\Jenis;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class DetailController extends Controller
{
    public function show()
    {
        if(Auth::user()->level == 'admin'){
            $dt_detail=Detail::get();
            return Response()->json($dt_detail);
        }else{
            return Response()->json('Anda Bukan admin');
        }
    }

    public function store(Request $req){
        if(Auth::user()->level == 'petugas'){
        
        $validator = Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jenis'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $harga = Jenis::where('id',$req->id_jenis)->first();
        $subtotal = $harga->harga_perkilo * $req->qty;

        $simpan = Detail::create([
            'id_transaksi'=> $req->id_transaksi,
            'id_jenis'=> $req->id_jenis,
            'subtotal'=> $subtotal,
            'qty'=> $req->qty
            
        ]);
        if($simpan){
            return Response()->json('Data Detail berhasil ditambahkan');
        }else{
            return Response()->json('Data Detail gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan Petugas');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'petugas'){

        $validator = Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jenis'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $harga = Jenis::where('id',$req->id_jenis)->first();
        $subtotal = $harga->harga_perkilo * $req->qty;

        $ubah = Detail::where('id', $id)->update([
            'id_transaksi'=> $req->id_transaksi,
            'id_jenis'=> $req->id_jenis,
            'subtotal'=> $subtotal,
            'qty'=> $req->qty
        ]);
        if($ubah){
            return Response()->json('Data Detail Transaksi berhasil diubah');
        }else{
            return Response()->json('Data Detail Transaksi gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan Petugas');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'admin'){

        $hapus = Detail::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Detail Transaksi berhasil dihapus');
        }else{
            return Response()->json('Data Detail Transaksi gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

}
