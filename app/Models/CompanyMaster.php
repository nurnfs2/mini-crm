<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'logo',
        'website',
        'status',
    ];

}
