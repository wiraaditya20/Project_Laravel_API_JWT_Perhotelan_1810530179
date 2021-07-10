<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resepsionis;
use Validator;

class ResepsionisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $resepsionis = Resepsionis::all();
        return response()->json($resepsionis);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_resepsionis' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);
        if ($validate->passes()){

            $resepsionis = Resepsionis::create($request->all());
            return response()->json([
                'message' => 'Data Resepsionis Berhasil Disimpan',
                'data' => $resepsionis
            ]);
        }
        return response()->json([
            'message' => 'Data Resepsionis Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($resepsionis)
    {
        $data = Resepsionis::where('id_resepsionis', $resepsionis)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data Resepsionis tidak ditemukan'], 404);
    }
    public function update(Request $request, $resepsionis)
    {
        $data = Resepsionis::where('id_resepsionis', $resepsionis)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_resepsionis' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Resepsionis Berhasil Diperbarui',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Resepsionis Gagal Diperbarui',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Resepsionis tidak ditemukan'
        ], 404);
    }
    public function destroy($resepsionis)
    {
        $data = Resepsionis::where('id_resepsionis', $resepsionis)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Resepsionis Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Resepsionis Berhasil Dihapus'
        ], 200);
    }
}
