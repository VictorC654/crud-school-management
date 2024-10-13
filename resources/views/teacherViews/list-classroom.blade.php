<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My classrooms
        </h2>
    </x-slot>

    <div class="py-12">
        <div>
            <form action="{{ route('classroom.create') }}" style="margin-left:400px;width:150px;padding:10px;color:white;border-radius:10px;background:green;">
                <button>
                    Create a classroom
                </button>
            </form>
        </div>
        <div style="display:flex;justify-content: center;">
            <div style="width:1300px;height:200px;display:flex;flex-wrap:wrap;justify-content: center;">
                @foreach($classrooms as $classroom)
                    <form method="GET" action="{{ route('classroom.show', ['id' => $classroom->id]) }}">
                        <button class="block max-w-sm border bg-gray-800 border-gray-200 shadow hover:bg-gray-700" style="margin:10px;height:250px;width:300px;cursor:pointer;">
                            <div style="display:flex;padding:20px;flex-direction: column;justify-content: flex-start;">
                                <div style="color:white;font-size:25px;">
                                    {{ $classroom->className }}
                                </div>
                                <div style="color:white;font-size:15px;">
                                    Number of students: {{ $classroom->countStudents() }}
                                </div>
                            </div>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
        </div>
</x-app-layout>
