<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{
    
    public function index()
    {
        $teacher = User::find(auth()->user()->id);
        if (Gate::denies('access-classrooms')) {
            return abort(403);
        }
        return view('teacherViews.list-classroom', [
            'classrooms' => $teacher->classrooms
        ]);
    }

    public function create()
    {
        return view('teacherViews.create-classroom-view', []);
    }

    public function store(StoreClassroomRequest $request)
    {
        if(auth()->user()->level === 2)
        {
            $classroom = Classroom::create([
                'className' => $request->name,
                'teacher_id' => $request->teacher_id,
            ]);
        } else {
            $classroom = Classroom::create([
                'className' => $request->name,
                'teacher_id' => auth()->user()->id,
            ]);
        }
        return redirect("/classrooms/" . $classroom->id);
    }

    public function show($id)
    {
        session(['classId' => $id]);
        $classroom = Classroom::findOrFail($id);
        if (Gate::denies('access-classroom-teacher', $classroom)) {
            return abort(403);
        }
        $students = $classroom->students;
        return view('teacherViews.show-classroom', [
           'classroom' => $classroom,
            'students' => $students,
        ]);
    }

    public function update($studentId)
    {
        ClassroomStudent::create([
            'classroom_id' => session('classId'),
            'user_id' => $studentId,
        ]);
        $user = User::findOrFail($studentId);
        if ($user) {
            $user->isEnrolled = true;
            $user->classroom_id = session('classId');
            $user->save();
        }
        return redirect()->back();
    }

    public function removeStudent($studentId)
    {
        $studentRecord = ClassroomStudent::where("user_id", "=", $studentId)->firstOrFail();
        $studentRecord->delete();

        $student = User::findOrfail($studentId);
        $student->isEnrolled = false;
        $student->save();

        return redirect()->back();
    }

    public function showForStudent($id)
    {
        $classroom = Classroom::findOrFail($id);
        $students = $classroom->students;
        if (Gate::denies('access-classroom', $classroom)) {
            return abort(403);
        }
        return view('studentViews.show-classroom', [
            'classroom' => $classroom,
            'students' => $students,
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        if (Gate::denies('access-director', $classroom)) {
            return abort(403);
        }
        foreach($classroom->students as $student)
        {
            $student->isEnrolled = false;
            $student->save();
        }
        $classroom->delete();
        return redirect()->to(route('all.classrooms'));
    }

    public function showAllClassrooms()
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        return view('directorViews.all-classrooms',[
            'classrooms' => Classroom::paginate(10),
        ]);
    }

    public function directorCreateClassroom()
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        return view('directorViews.create-classroom', [
            'teachers' => User::where("level", "=" , 1)->get(),
        ]);
    }
}
