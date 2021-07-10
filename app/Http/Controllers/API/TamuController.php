<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tamu;
use Validator;

class TamuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $tamus = Tamu::all();
        return response()->json($tamus);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_tamu' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);
        if ($validate->passes()){

            $tamus = Tamu::create($request->all());
            return response()->json([
                'message' => 'Data Tamu Berhasil Disimpan',
                'data' => $tamus
            ]);
        }
        return response()->json([
            'message' => 'Data Tamu Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($tamus)
    {
        $data = Tamu::where('id_tamu', $tamus)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data Tamu tidak ditemukan'], 404);
    }
    public function update(Request $request, $tamus)
    {
        $data = Tamu::where('id_tamu', $tamus)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_tamu' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Tamu Berhasil Diperbarui',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Tamu Gagal Diperbarui',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Tamu tidak ditemukan'
        ], 404);
    }
    public function destroy($tamus)
    {
        $data = Tamu::where('id_tamu', $tamus)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tamu Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Tamu Berhasil Dihapus'
        ], 200);
    }
}
