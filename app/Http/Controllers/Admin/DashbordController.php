<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeMaster;
use App\Models\CompanyMaster;
use App\Models\User;


class DashbordController extends Controller
{
    //


    public function getTotalCompany() {
        $data = CompanyMaster::get();
        return $data;
    }

    public function getTotalEmployee() {
        $data = EmployeeMaster::get();
        return $data;
    }

    public function getTotalUser() {
        $data = User::get();
        return $data;
    }


}
