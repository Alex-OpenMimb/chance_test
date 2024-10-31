<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $students = Student::get();
            return $this->successResponse( StudentResource::collection( $students ) );

        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), 409);
        }
    }
}
