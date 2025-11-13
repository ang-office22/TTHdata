<?php

namespace App\Http\Controllers;

use App\Models\CustomerTTH;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerTTHController extends Controller
{
     // >> Read
    public function index()
    {
        // cek filter
        if ($_GET == null) {
            $custth = CustomerTTH::all();
            return response()->json(
                [
                    'success' => true,
                    'message' => "Berhasil mengambil data",
                    'data' => $custth
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
            'TTHNo' => 'required|size:18',
            'SalesID' => 'required|size:10',
            'TTOTTPNo' => 'required|size:19',
            'CustID' => ['required', Rule::exists('dbo.customer', 'CustID')],
        ],);

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
        $lasttth = CustomerTTH::orderBy('ID', 'asc')->first();
        // Tambahkan tth
        $id = 1;
        if($lasttth != null){
            $id += $lasttth->ID;
        }
        $addedTTH = CustomerTTH::create(
            [
                'ID' =>  $id,
                'TTHNo' => $request->tthno,
                'SalesID' => $request->salesid,
                'TTOTTPNo' => $request->ttottpno,
                'CustID' => $request->custid,
                'DocDate' => Carbon::now(),
            ]
        );
    }

    // >> Delete
    public function delete(Request $request){
        // cek custId
        $custth = CustomerTTH::where('ID', '=', $request->id)->delete();

        if($custth > 0){
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
