<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
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



    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        try {
             $data = $request->all();
             $student =   Student::create( $data );
            return $this->successResponse( new StudentResource( $student ),'student created successfully' );

        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), 409);
        }
    }


    public function search( $idGrade  )
    {
        try {
            $students =   Student::join('grades','students.grade_id','grades.id')
                               ->where('grades.id', $idGrade)->get();
            return $this->successResponse(  $students,'Successfully' );

        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(), 409);
        }
    }
}
