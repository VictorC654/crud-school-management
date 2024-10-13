<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function search()
    {
        $users = User::where('isEnrolled', false)
            ->where('level', 0)
            ->orderBy('created_at', 'DESC')->paginate();
        return view('teacherViews.students-search',
        [
            'students' => $users
        ]);
    }

    public function show()
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        return view("directorViews.all-students", [
            'students' => User::where("level", "=", 0)->paginate(10),
        ]);
    }

    public function showAllTeachers()
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        return view("directorViews.all-teachers", [
            'teachers' => User::where('level', '=', 1)->paginate(10),
        ]);
    }

    public function destroy($id)
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function makeTeacher($id)
    {
        if (Gate::denies('access-director')) {
            return abort(403);
        }
        $user = User::findOrFail($id);
        $user->level = 1;
        $user->save();
        return redirect()->back();
    }
}
