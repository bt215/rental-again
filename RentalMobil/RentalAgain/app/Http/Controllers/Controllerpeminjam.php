<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjam;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\User;
use DB;
use Session;

class Controllerpeminjam extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level =="admin" ){
    
    $simpan=peminjam::create([
            'nama_peminjam'=>$req->nama_peminjam,
            'no_telp'=>$req->no_telp,
            'alamat'=>$req->alamat,
            'nik'=>$req->nik,
            
        
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
                $validator=Validator::make($req->all(),
            [
                'nama_peminjam'=>'required',
                'no_telp'=>'required',
                'alamat'=>'required',
                'nik'=>'required',
                
    
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    $ubah=peminjam::where('id',$id)->update([
        'nama_peminjam'=>$req->nama_peminjam,
        'no_telp'=>$req->no_telp,
        'alamat'=>$req->alamat,
        'nik'=>$req->nik,
        
    
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
        $hapus=peminjam::where('id',$id)->delete();
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
        $datapeminjam = peminjam::get();
        $arr_data = array();
        foreach($datapeminjam as $data) {
            $arr_data[] = array(
                'nama peminjam'=>$data->nama_peminjam,
                'almaat'=>$data->alamat,
                'no_telp'=>$data->no_telp,
                'nik'=>$data->nik,
        
            );
        
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
    
        return Response()->json($arr_data);
    }
    }
    

