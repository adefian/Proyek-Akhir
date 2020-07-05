<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetugasLapangan;
use App\User;
class PetugasLapanganController extends Controller
{
    
    public function PetugasLapangan() 
    {

		  $hadiahku= PetugasLapangan::all();

        foreach ($hadiahku as $value) {
            $array[]=[
                'id'    =>$value->id,
                'nama' =>$value->nama,
                'nohp' =>$value->nohp,
                'alamat'=>$value->alamat,
                'role' => $value->user->role
            ];        
        }
   		
      return response()->json([
              'pesan' =>'sukses lah',
              'upload' => $array

      	],200);
	   }

   	 public function TambahPetugasLapangan (Request $request){
    	
      $data = new PetugasLapangan;
    	$data->nama = $request->input('nama');
    	$data->nohp = $request->input('nohp');
    	$data->alamat = $request->input('alamat');
    	$data->save();

    	return "Berhasil";
    }

    public function DataPetugasLapangan( $id)
    {
    
      $data =  PetugasLapangan::where('user_id',$id)->first();
      $array[]=[
          'id'=> $data->id,
          'nama'=> $data->nama,
          'nohp'=> $data->nohp,
          'alamat'=>   $data->alamat,
          'username'=> $data->user->username,
          'email'=>   $data->user->email,
          'file_gambar'=>$data->file_gambar
      
    ];

    return response()->json($array);
    }

    public function edit(Request $request, $id)
    {
    
      $file = $request->input('file_gambar');
      $nama= $request->input('nama');
      $nohp= $request->input('nohp');
      $alamat= $request->input('alamat');
      $nama_file = time()."_".".jpeg";
      // $tujuan_upload = '../resource/gambar/';
      $tujuan_upload = 'foto_user/';

        if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) 
        {
     
          $pesan ="Kritik dan Saran Berhasil Ditambahkan";

        } else if ($nama&&$nohp&&$alamat) {
        
          $pesan ="Kritik dan Saran Berhasil Ditambahkan";

        }else{
          
          $pesan ="Terjadi Kesalahan";
        }
        
          $data =  PetugasLapangan::where('user_id',$id)->first();
        
         $input =([
          
            'nama'=> $request->nama,
            'nohp'=> $request->nohp,
            'alamat'=> $request->alamat,
            'user_id'=>$data->user->id
          
          ]);

          if ($request->input('file_gambar')) {
              $input['file_gambar'] = $nama_file;
          }

          $i =$data->user_id;
          $user=User::findOrFail($i);

          $input2 =([
          'username'=> $request->username,
            'email'=> $request->email
          ]);

          $user->update($input2);
          $data->update($input);

          return response()->json([
               'pesan' =>'sukses lah',
               'upload' => $user,$data

        ],200);
          
    }
   
}
