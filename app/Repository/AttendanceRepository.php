<?php


namespace App\Repository;


use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }

    public function Attendance_tomo($id){

         $students = Attendance::where('section_id', $id)->get();

         foreach($students as $student){

              if(Student::where('id',$student->student_id)->get() == null){

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }
            
            $students = Student::where('id',$student->student_id)->get();
            
          
         }
         return view('pages.Attendance.attendance', compact('students'));

    }

    public function store($request)
    {
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                if(Attendance::where('student_id' ,'=', $studentid)->where('attendence_date',date('Y-m-d'))->count() > 1){

                 toastr()->error(trans('attandence done for today'));
                  return redirect()->back();


            }else{

               
                   Attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);

            }

            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
