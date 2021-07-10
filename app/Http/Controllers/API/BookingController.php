<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use Validator;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        // $transaksis = Transaksi::all();
        $bookings = Booking::with('Resepsionis', 'Tamu', 'Room')->get();
        return response()->json($bookings);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_resepsionis' => 'required',
            'id_tamu' => 'required',
            'id_kamar' => 'required',
            'tanggal_checkin' => 'required',
            'tanggal_checkout' => 'required',
            'total_bayar' => 'required'
        ]);
        if ($validate->passes()){

            $bookings = Booking::create($request->all());
            return response()->json([
                'message' => 'Data Booking Berhasil Disimpan',
                'data' => $bookings
            ]);
        }
        return response()->json([
            'message' => 'Data Booking Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($bookings)
    {
        $bookings = Booking::with('Resepsionis', 'Tamu', 'Room')->where('id_booking', $bookings)->first();
        return response()->json($bookings);
    }
     public function update(Request $request, $bookings)
    {
        $data = Booking::where('id_booking', $bookings)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'id_resepsionis' => 'required',
            'id_tamu' => 'required',
            'id_kamar' => 'required',
            'tanggal_checkin' => 'required',
            'tanggal_checkout' => 'required',
            'total_bayar' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Booking Berhasil Disimpan',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Booking Gagal Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Booking tidak ditemukan'
        ], 404);
    }
    public function destroy($bookings)
    {
        $data = Booking::where('id_booking', $bookings)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Booking Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Booking Berhasil Dihapus'
        ], 200);
    }
}
