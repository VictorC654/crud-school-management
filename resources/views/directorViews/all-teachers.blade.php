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
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Classrooms</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;"> {{ $teacher->name }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            @if(!$teacher->classrooms->isEmpty())
                            @foreach($teacher->classrooms as $classroom)
                                {{ $classroom->className }} /
                            @endforeach
                            @else
                                <i>No classrooms yet</i>
                            @endif
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            <form method="POST" action="{{ route('delete.user', ['id' => $teacher->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding:10px;color:white;border-radius:10px;" class="bg-red-500">
                                    Delete teacher
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:40px;">
            {{ $teachers->onEachSide(5)->links() }}
        </div>
    </div>
</x-app-layout>
