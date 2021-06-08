<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        if($karyawan)
        {
            return response()->json([
                'success'=>true,
                'data'=>$karyawan
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Data tidak ditemukan'
            ],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request,all(),[
            'nik'=>'number|required',
            'id_departemen'=>'string|required',
            'id_jabatan'=>'string|required',
            'nama'=>'string|required',
            'tempat_lahir'=>'string|required',
            'jk'=>'string|required',
            'telp'=>'number|required',
            'alamat'=>'string|required',
            'status_pegawai'=>'number|required',
            'pendidikan'=>'string|required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $karyawan = Karyawan::create([
            'nik'=>$request->nik,
            'id_departemen'=>$request->id_departemen,
            'id_jabatan'=>$request->id_jabatan,
            'nama'=>$request->nama,
            'tempat_lahir'=>$request->tempat_lahir,
            'jk'=>$request->jk,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat,
            'status_pegawai'=>$request->status_pegawai,
            'pendidikan'=>$request->pendidikan
        ]);

        if($karyawan)
        {
            return response()->json([
                'success'=>true,
                'data'=>$karyawan
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal simpan'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success'=>true,
            'data'=>Karyawan::find($id)
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nik'=>'number',
            'id_departemen'=>'string',
            'id_jabatan'=>'string',
            'nama'=>'string',
            'tempat_lahir'=>'string',
            'jk'=>'string',
            'telp'=>'number',
            'alamat'=>'string',
            'status_pegawai'=>'number',
            'pendidikan'=>'string'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $karyawan = Karyawan::where('nik',$id)
                    ->update([
                        'id_departemen'=>$request->id_departemen,
                        'id_jabatan'=>$request->id_jabatan,
                        'telp'=>$request->telp,
                        'alamat'=>$request->alamat,
                        'status_pegawai'=>$request->status_pegawai,
                        'pendidikan'=>$request->pendidikan
                    ]);
        if($karyawan)
        {
            return response()->json([
                'success'=>true,
                'data'=>$karyawan
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal update'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        if($karyawan)
        {
            return response()->json([
                'success'=>true,
                'message'=>'Berhasil dihapus'
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal dihapus'
            ],500);
        }
    }
}
