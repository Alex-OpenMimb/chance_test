<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        try{
            $students = Grade::get();
            return $this->successResponse( $students );

        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), 409);
        }
    }
}
