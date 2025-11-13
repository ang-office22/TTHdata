<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\CustomerData;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\info;

class CustomerController extends Controller
{
    // >> Read
    public function index()
    {
        // cek filter
        if ($_GET == null) {
            $cus = CustomerData::all();
            return response()->json(
                [
                    'success' => true,
                    'message' => "Berhasil mengambil data",
                    'data' => $cus
                ],
                201
            ); // kasih berhasil
        }
    }

    // >> Add
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string',
            'Address' => 'required|string',
            'BranchCode' => 'required|string',
            'PhoneNo' => [
                'required',
                'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/', // format nomor Indonesia
                'unique:customers,phone'
            ],
        ], [
            'PhoneNo.regex' => 'Nomor telepon tidak valid. Gunakan format Indonesia (contoh: 628123456789).',
            'PhoneNo.unique' => 'Nomor telepon sudah terdaftar.',
        ]);

        // Cek Validasi
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => []
                ],
                422
            );
        }
        // Jika berhasil
        // Check Branchcodenya apa sudah pernah ada
        $latest = CustomerData::max('CustID')->where('BranchCode', "=" , $request->branchcode);
        info($latest);

        // cek id baru
        $newID = $request->branchcode . "00000001" ;
        if($latest != null){
            // Pisahkan prefix huruf/angka di depan dan angka di belakang
            if (preg_match('/^(\D*\d*[A-Z]*\d*)(\d{1,})$/', $latest, $matches)) {
                $prefix = $matches[1]; // bagian depan
                $number = $matches[2]; // bagian angka belakang

                $newNumber = (int)$number + 1;

                // Pertahankan panjang digit aslinya (contoh: 0033 jadi 0034)
                $newID = $prefix . str_pad($newNumber, strlen($number), '0', STR_PAD_LEFT);
            }
        }        

        // Tambah Customer
        $customer = CustomerData::create(
            [
                'CustID' => $newID,
                'Name' => $request->name,
                'Address' => $request->address,
                'BranchCode' => $request->branchcode,
                'PhoneNo' => $request->phoneno,
            ]
        );
    }

    // >> Delete
    public function delete(Request $request){
        // cek custId
        $cus = CustomerData::where('custID', '=', $request->custID)->delete();

        if($cus > 0){
            return response()->json([
                'success' => true,
                'message'=> 'data berhasil dihapus',
                'data' => [] 
            ] ,200);
        }
        else{
            return response()->json([
                'success' => false,
                'message'=> 'data gagal dihapus',
                'data' => [] 
            ] ,404);
        }
    }
}
