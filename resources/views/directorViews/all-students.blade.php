<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All students
        </h2>
    </x-slot>
    <div class="py-12">
        <div style="display:flex;justify-content: center;">
            <table style="width:80%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;width:40%;">Student Name</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Class</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Teacher</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;"> {{ $student->name }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            @if($student->classroom)
                                {{ $student->classroom->className }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            @if($student->classroom)
                                {{ $student->classroom->teacher->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;display:Flex;">
                            <form method="POST" action="{{ route('delete.user', ['id' => $student->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="margin-right:10px;padding:10px;color:white;border-radius:10px;" class="bg-red-500">
                                    Delete student
                                </button>
                            </form>
                            @if(!$student->isEnrolled)
                            <form method="POST" action="{{ route('make.teacher', ['id' => $student->id]) }}">
                                @csrf
                                <button type="submit" style="background:green;padding:10px;color:white;border-radius:10px;" class="">
                                    Make teacher
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:40px;">
            {{ $students->onEachSide(5)->links() }}
        </div>
    </div>
</x-app-layout>
