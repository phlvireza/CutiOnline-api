<?php

namespace App\Http\Controllers;

use App\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = Departemen::all();
        if($departemen)
        {
            return response()->json([
                'success'=>true,
                'data'=>$departemen,
            ],200);
        }
        else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Data tidak ada',
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
            'nama_departemen' => 'required|string'
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message'=>'gagal',
                'error'=>$validator->errors(),
            ],422);
        }

        $departemen = Departemen::create([
            'nama_departemen'=>$request->nama_departemen
        ]);

        if($departemen)
        {
            return response()->json([
                'success'=>true,
                'data'=>$departemen,
            ],200);
        }
        else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal simpan',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success'=>true,
            'data'=>Departemen::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function edit(Departemen $departemen)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_departemen'=> 'string'
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message'=>'Gagal',
                'error'=>$validator->errors(),
            ],422);
        }

        $update = Departemen::where('id_departemen',$id)
                    ->update([
                        'nama_departemen'=>$request->nama_departemen,
                    ]);
        if($update)
        {
            return response()->json([
                'success'=>true,
                'data'=>Departemen::where('id_departemen',$id)->first()
            ],200);
        }
        else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal update',
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Departemen::where('id_departemen',$id)->delete();
        //$delete = $departemen->delete();
        if($delete)
        {
            return response()->json([
                'success'=>true,
                'message'=>'Berhasil dihapus',
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Gagal dihapus',
            ],500);
        }

    }
}
