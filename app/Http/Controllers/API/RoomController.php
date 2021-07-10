<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Validator;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $rooms = Room::all();
        return response()->json($rooms);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'no_kamar' => 'required',
            'jenis' => 'required',
            'ukuran' => 'required',
            'harga' => 'required'
        ]);
        if ($validate->passes()){

            $rooms = Room::create($request->all());
            return response()->json([
                'message' => 'Data Kamar Berhasil Disimpan',
                'data' => $rooms
            ]);
        }
        return response()->json([
            'message' => 'Data Kamar Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($rooms)
    {
        $data = Room::where('id_kamar', $rooms)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data Kamar tidak ditemukan'], 404);
    }
    public function update(Request $request, $rooms)
    {
        $data = Room::where('id_kamar', $rooms)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'no_kamar' => 'required',
            'jenis' => 'required',
            'ukuran' => 'required',
            'harga' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Kamar Berhasil Diperbarui',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Kamar Gagal Diperbarui',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Kamar tidak ditemukan'
        ], 404);
    }
    public function destroy($rooms)
    {
        $data = Room::where('id_kamar', $rooms)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Kamar Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Kamar Berhasil Dihapus'
        ], 200);
    }
}
