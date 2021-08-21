<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
use App\Http\Requests\StoreTeachers;
use App\Models\Gender;
use App\Models\Specialication;
use App\Models\Teacher;

class TeachersController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
 
        $sections = $this->Teacher->getAllSections();

        //$Teachers = Teacher::all();
        return view('pages.Teachers.Teachers',compact('Teachers','sections'));
    }

    public function create()
    {
         $specializations = $this->Teacher->Getspecialization();
         $genders = $this->Teacher->GetGender();
         return view('pages.Teachers.create',compact('specializations','genders'));
    }


    public function store(StoreTeachers $request)
    {
      return $this->Teacher->StoreTeachers($request);
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }


    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
}