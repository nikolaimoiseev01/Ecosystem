<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function downloadDiploma(Request $request) {
        $user = User::where('id', $request->user_id)->first();
        $user_fio = "{$user['surname']} {$user['name']} {$user['thirdname']}";
        $user_points =$user->testResult->sum('applicant_points');
        if ($user_points > 80) {
            $type = 'финалистом';
        } else {
            $type = 'участником';
        }
        return view('layouts.diploma', ['fio' => $user_fio, 'type' => $type]);
    }
}
