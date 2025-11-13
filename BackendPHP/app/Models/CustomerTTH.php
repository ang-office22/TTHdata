<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTTH extends Model
{
    
    public $table = "customertth";

    protected $fillable = [
        "ID",
        "TTHNo",
        "SalesID",
        "TTOTTPNo",
        "CustID",
        "DocDate", // Default created time
        'Received', // null 
        'ReceivedDate', // null saat dibuat
        'FailedReason' // alasan ga diterima emas/voucher?
    ];
    use HasFactory;
}
