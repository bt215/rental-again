<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datamobil;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\User;
use DB;
use Session;

class Controllerdatamobil extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level =="admin" ){
    
    $simpan=datamobil::create([
            'nama_mobil'=>$req->nama_mobil,
            'tahun_mobil'=>$req->tahun_mobil,
            'kondisi'=>$req->kondisi,
            'plat_nomor'=>$req->plat_nomor,
            
        
    ]);
    if($simpan){
        return response ()->json(['status'=>'berhasil tambah data']);
    }
    else{
        return response ()->json(['status'=>'gagal']);
    }
        }
    }
      
    

    public function update($id,Request $req){
            if(Auth::user()->level=="admin"){
            
      
    $ubah=datamobil::where('id',$id)->update([
        'nama_mobil'=>$req->nama_mobil,
            'tahun_mobil'=>$req->tahun_mobil,
            'kondisi'=>$req->kondisi,
            'plat_nomor'=>$req->plat_nomor,
    
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
}else{
    return Response()->json(['status'=>'bukan admin :(']);
}
    
    }
    public function destroy($id){
        if(Auth::user()->level=="admin"){
        $hapus=datamobil::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
}
    public function show(){
        if(Auth::user()->level=="admin"){
        $datamobil = datamobil::get();
        $arr_data = array();
        foreach($datamobil as $data) {
            $arr_data[] = array(
                'nama_mobil'=>$data->nama_mobil,
            'tahun_mobil'=>$data->tahun_mobil,
            'kondisi'=>$data->kondisi,
            'plat_nomor'=>$data->plat_nomor,
            );
        
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
    
        return Response()->json($arr_data);
    }
    }
    

