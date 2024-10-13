<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $classroom->className }}
        </h2>
        Teacher: {{ $classroom->teacher->name }}
    </x-slot>
    <div style="display:flex;width:80%;margin-left:185px;">
        <div style="display:flex;justify-content: flex-start;width:50%;margin-top:50px;">
            @if(auth()->user()->level === 2)
            <form action="{{ route('classroom.delete', ['classroom' => $classroom]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding:10px;color:white;border-radius:10px;" class="bg-red-500">Delete classroom</button>
            </form>
            @endif
        </div>
        <div style="display:flex;justify-content: flex-end;width:50%;margin-top:50px;">
            <form action="{{ route('search') }}" method="GET">
                <button style="padding:10px;color:white;border-radius:10px;background:green;" class="">Add students</button>
            </form>
        </div>
    </div>
    <div class="py-12">
        <div style="display:flex;justify-content: center;">
        <table style="width:80%; border-collapse: collapse;">
            <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;width:70%;">Student Name</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> {{ $student->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">
                    <form method="POST" action="{{ route('student.remove', ['id' => $student->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding:10px;color:white;border-radius:10px;" class="bg-red-500">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>
