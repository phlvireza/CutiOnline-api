<?php

namespace App\Http\Controllers;

use App\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti = Cuti::all();
        if($cuti)
        {
            return response()->json([
                'success'=>true,
                'data'=>$cuti
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
        $validator = Validator::make($request->all(),[
            'id_jeniscuti'=>'required|string',
            'nik'=>'required|number',
            'mulai_cuti'=>'required|string',
            'akhir_cuti'=>'required|string',
            'jumlah_cuti'=>'required|number',
            'sisa_cuti'=>'required|number',
            'keterangan'=>'required|string'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $cuti = Cuti::create([
            'id_jeniscuti'=>$request->id_jeniscuti,
            'nik'=>$request->nik,
            'mulai_cuti'=>$request->mulai_cuti,
            'akhir_cuti'=>$request->akhir_cuti,
            'jumlah_cuti'=>$request->jumlah_cuti,
            'sisa_cuti'=>$request->sisa_cuti,
            'keterangan'=>$request->keterangan
        ]);
        if($cuti)
        {
            return response()->json([
                'success'=>true,
                'data'=>$cuti
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
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success'=>true,
            'data'=>Cuti::find($id)
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'id_jeniscuti'=>'string',
            'nik'=>'number',
            'mulai_cuti'=>'string',
            'akhir_cuti'=>'string',
            'jumlah_cuti'=>'number',
            'sisa_cuti'=>'number',
            'keterangan'=>'string'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $cuti = Cuti::where('id_cuti',$id)
                ->update([
                    'id_jeniscuti'=>$request->id_jeniscuti,
                    'mulai_cuti'=>$request->mulai_cuti,
                    'akhir_cuti'=>$request->akhir_cuti,
                    'jumlah_cuti'=>$request->jumlah_cuti,
                    'sisa_cuti'=>$request->sisa_cuti,
                    'keterangan'=>$request->keterangan
                ]);
        if($cuti)
        {
            return response()->json([
                'success'=>true,
                'data'=>$cuti
            ],200);
        }
        else{
            return response()->json([
                'succes'=>false,
                'message'=>'Gagal update'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        $cuti = Cuti::find($id);
        $cuti->delete();
        if($cuti)
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
