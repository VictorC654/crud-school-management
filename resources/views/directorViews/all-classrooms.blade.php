<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All students
        </h2>
    </x-slot>
    <div class="py-12">
        <div style="display:flex;margin-bottom:50px;">
            <div style="display:flex;justify-content: flex-end;width:50%;margin-top:50px;">
                <form action="{{ route('create.classroom') }}" method="GET">
                    <button style="padding:10px;color:white;border-radius:10px;background:green;" class="">Create classroom</button>
                </form>
            </div>
        </div>
        <div style="display:flex;justify-content: center;">
            <table style="width:80%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;width:40%;">Class Name</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Teacher</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nr. of students</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classrooms as $classroom)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            <form action="{{ route('classroom.show', ['id' => $classroom->id]) }}">
                                <button style="text-decoration: underline;">
                                    {{ $classroom->className }}
                                </button>
                            </form>
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $classroom->teacher->name }}
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $classroom->countStudents() }} students
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;display:Flex;">
                            <form method="POST" action="{{ route('classroom.delete', ['classroom' => $classroom]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="margin-right:10px;padding:10px;color:white;border-radius:10px;" class="bg-red-500">
                                    Delete classroom
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:40px;">
{{--            {{ $students->onEachSide(5)->links() }}--}}
        </div>
    </div>
</x-app-layout>
