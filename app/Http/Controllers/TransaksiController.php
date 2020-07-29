<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Poin;
use App\Hadiah;
use App\User;
use App\Transaksi;
use App\Masyarakat;

class TransaksiController extends Controller
{

  public function transaksi(Request $request, $id)
  {

    $file = $request->file_gambar;
    $nama_hadiah = $request->nama_hadiah;
    $harga_hadiah = $request->harga_hadiah;
    $sisapoin = $request->sisapoin;

    $nama_file = time() . "_" . ".jpeg";
    //$tujuan_upload = public_path() . '../resource/gambar/';
    $tujuan_upload = public_path() . '/transaksi/';

    if (file_put_contents($tujuan_upload . $nama_file, base64_decode($file))) {
      // code...
      // $response['code'] =1;
      $response['msg'] = " Berhasil Ditambahkan";
      echo "Sukses Photo" . $response['msg'];
    } else if ($nama_hadiah && $harga_hadiah && $sisapoin) {
      // code...
      // $response['code'] =2;
      $response['msg'] = " Berhasil Ditambahkan";
    } else {
      // $response['code'] =0;
      $response['msg'] = "Terjadi Kesalahan";
    }

    $data =  Masyarakat::where('user_id', $id)->first();

    $input = ([
      'total_poin' => $request->total_poin,
      'masyarakat_id' => $data->id,

    ]);

    $str_random = Str::random(5);

    $data->update($input);
    $mas = new Transaksi;
    $mas->nama_hadiah = $request->nama_hadiah;
    $mas->harga_hadiah = $request->harga_hadiah;
    $mas->jumlah_hadiah = $request->jumlah_hadiah;
    $mas->sisapoin = $request->sisapoin;
    $mas->file_gambar = $request->file_gambar;
    $mas->masyarakat_id = $data->id;
    $mas->kode_transaksi = $str_random;
    $mas->save();

    return response()->json([
      'pesan' => 'sukses lah',
      'upload' => $data, $mas

    ], 200);
  }

  public function LihatTransaksi($id)
  {
    // $data =  Masyarakat::findOrFail($id);
    $username =  Masyarakat::where('user_id', $id)->first();
    $trans =  Transaksi::where('masyarakat_id', $username->id)->get();

    $array = [];
    foreach ($trans as $datas => $data) {
      $array[] = [
        'id' => $data->id,
        'nama_hadiah' => $data->nama_hadiah,
        'harga_hadiah' => $data->harga_hadiah,
        'sisapoin' => $data->sisapoin,
        'jumlah_hadiah' => $data->jumlah_hadiah,
        'file_gambar' => $data->file_gambar,
        'kode_transaksi' => $data->kode_transaksi
      ];
    }
    return response()->json(['upload' => $array]);
    //      return response()->json([
    //        'pesan' =>'sukses lah',
    //        'upload' => $array

    // ],200);
    // return response()->json($array);
  }
}