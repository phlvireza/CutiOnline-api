<?php

namespace App\Http\Controllers;

use App\Jeniscuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeniscutiController extends Controller
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
                'data'=>$cuti,
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
            'nama_jeniscuti'=>'required|string'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $jeniscuti = Jeniscuti::create([
            'nama_jeniscuti'=>$request->nama_jeniscuti
        ]);
        if($jeniscuti)
        {
            return response()->json([
                'success'=>true,
                'data'=>$jeniscuti
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
     * @param  \App\Jeniscuti  $jeniscuti
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success'=>true,
            'data'=>Jeniscuti::find($id)
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jeniscuti  $jeniscuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Jeniscuti $jeniscuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jeniscuti  $jeniscuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all,[
            'nama_jeniscuti'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'success'=>'Gagal',
                'error'=>$validator->errors()
            ],422);
        }

        $jeniscuti = Jeniscuti::where('id_jeniscuti',$id)
                    ->update([
                        'nama_jeniscuti'=>$request->nama_jeniscuti
                    ]);

        if($jeniscuti)
        {
            return response()->json([
                'success'=>true,
                'data'=>Jeniscuti::where('id_jeniscuti',$id)
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
     * @param  \App\Jeniscuti  $jeniscuti
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jeniscuti = Jeniscuti::find($id);
        $jeniscuti->delete();
        if($jeniscuti)
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
