<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\User;
use DB;
use Session;

class Controllerjenis extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level =="admin" ){
    
    $simpan=jenis::create([
            
            'jenis_mobil'=>$req->jenis_mobil,
            
        
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
          
        
    $ubah=jenis::where('id',$id)->update([
        'jenis_mobil'=>$req->jenis_mobil
    
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
        $hapus=jenis::where('id',$id)->delete();
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
        $datajenis = jenis::get();
        $arr_data = array();
        foreach($datajenis as $data) {
            $arr_data[] = array(
                'jenis_mobil'=>$data->jenis_mobil
        
            );
        
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
    
        return Response()->json($arr_data);
    }
    }
    

