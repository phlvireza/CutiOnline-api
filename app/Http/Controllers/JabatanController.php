<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        if($jabatan)
        {
            return response()->json([
                'success'=>true,
                'data'=>$jabatan,
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Data tidak ditemukan',
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
            'nama_jabatan'=>'required|string'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors(),
            ],422);
        }

        $jabatan = Jabatan::create([
            'nama_jabatan'=>$request->nama_jabatan
        ]);
        if($jabatan)
        {
            return response()->json([
               'success'=>true,
               'data'=>$jabatan, 
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal simpan',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success'=>true,
            'data'=>Jabatan::find($id),
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_jabatan'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors(),
            ],422);
        }

        $jabatan = Jabatan::where('id_jabatan',$id)
                    ->update([
                        'nama_jabatan'=>$request->nama_jabatan,
                    ]);
        if($jabatan)
        {
            return response()->json([
                'success'=>true,
                'data'=>Jabatan::where('id_jabatan',$id)->first(),
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal update',
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        if($jabatan)
        {
            return response()->json([
                'success'=>true,
                'message'=>'Berhasil dihapus',
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
