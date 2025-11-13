<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{
    public $table = "customer";

    protected $fillable = [
        "CustID",
        "Name",
        "Address",
        "BranchCode",
        "PhoneNo",
    ];
    use HasFactory;
}
