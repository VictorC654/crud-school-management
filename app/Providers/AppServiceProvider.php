<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\ClassroomStudent;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-classrooms', function ($user) {
            return $user->level === 1 || $user->level === 2;
        });
        Gate::define('access-director', function ($user) {
            return $user->level === 2;
        });
        Gate::define('access-classroom', function($user, $classroom) {
            return $user->level === 2 || ClassroomStudent::where('classroom_id', $classroom->id)
                ->where('user_id', $user->id)
                ->exists();
        });
        Gate::define('access-classroom-teacher', function($user, $classroom) {
            return $user->level === 2 || Classroom::where('id', $classroom->id)
                ->where('teacher_id', $user->id)
                ->exists();
        });
    }
}
