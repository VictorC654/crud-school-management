<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create classroom
        </h2>
    </x-slot>

    <div class="py-12">
        <div style="display:Flex;justify-content: center;background:#FAF9F6;width:50%;margin:0 auto;height:500px;border-radius:50px;">
            <form action="{{ route('classroom.store') }}" method="POST">
                @csrf
                <div style="margin-top:200px;">
                    <label>
                        Classroom name
                        <input style="margin-bottom:10px;" type="text" name="name" required /><br>
                        <label>
                            Select a teacher
                            <select name="teacher_id">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </label>
                    <button type="submit" style="padding:10px;color:white;border-radius:10px;background:green;">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

