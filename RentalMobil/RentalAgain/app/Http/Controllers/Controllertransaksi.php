<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use DB;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
class Controllertransaksi extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level=="admin"){
            $validator=Validator::make($req->all(),
        [
            
            'id_petugas'=>'required',
            'id_pelanggan'=>'required',
            'tgl_transaksi'=>'required',
            
            
        ]
    ); 
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $date=date("y-m-d H:i:s");
    $deadline=date("y-m-d H:i:s",strtotime('+3 days',strtotime($date)));
    $simpan=transaksi::create([
            
            'tgl_transaksi'=>$date,
            'tgl_selesai'=>$deadline,
            'id_pelanggan'=>$req->id_pelanggan,
            'harga'=>$req->harga,
            'id_petugas'=>Auth::user()->id,
        
    ]);
    if($simpan){
        return response ()->json(['status'=>'berhasil tambah data']);
    }
    else{
        return response ()->json(['status'=>'gagal']);
    }
        }
        else{
            return response()->json(['status'=>'gagal :(']);                                      
        }
    }
    public function update($id,Request $req){
        $validator=Validator::make($req->all(),
        [
            'id_petugas'=>'required',
            'id_pelanggan'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_selesai'=>'required'
            
           
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $ubah=tiket::where('id',$id)->update([
        'tgl_transaksi'=>$req->tgl_transaksi,
        'tgl_selesai'=>$req->tgl_selesai,
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas
        
        
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
    
    }
    public function destroy($id){
        $hapus=tiket::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }
    public function show(Request $req){
        if(Auth::user()->level == "admin"){
            $transaksi = DB::table('transaksi')->join('pelanggan','pelanggan.id','=','transaksi.id_pelanggan')
            ->where('transaksi.tgl_transaksi','>=',$req->tgl_transaksi)
            ->where('transaksi.tgl_transaksi','<=',$req->tgl_selesai)
            ->select('nama','no_telp','alamat','transaksi.id','tgl_transaksi','tgl_selesai')
            ->get();
            
            if($transaksi->count() > 0){

            $data_transaksi = array();
            foreach ($transaksi as $t){
                
                $grand = DB::table('detail')->where('id_transaksi','=',$t->id)
                ->groupBy('id_transaksi')
                ->select(DB::raw('sum(subtotal) as grandtotal'))
                ->first();
                
                $detail = DB::table('detail')->join('jenis','detail.id_jenis','=','jenis.id')
                ->where('id_transaksi','=',$t->id)
                ->get();
                

                $data_transaksi[] = array(
                    'tgl' => $t->tgl_transaksi,
                    'nama pelanggan' => $t->nama,
                    'alamat' => $t->alamat,
                    'telp' => $t->no_telp,
                    'tgl_jadi' => $t->tgl_selesai,
                    'grand total' => $grand, 
                    'detail' => $detail,
                );
                
            }
            return response()->json(compact('data_transaksi'));
        
    }else{
            $status = 'tidak ada transaksi antara tanggal '.$req->tgl_transaksi.' sampai dengan tanggal '.$req->tgl_selesai;
            return response()->json(compact('status'));
    }
        }else{
            return Response()->json('Anda Bukan Petugas');
        }
}
}
