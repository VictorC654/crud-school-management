<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $classroom->className }}
        </h2>
        Teacher: {{ $classroom->teacher->name }}
    </x-slot>
    <div class="py-12">
        <div style="display:flex;justify-content: center;">
            <table style="width:80%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;width:70%;">Student Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;"> {{ $student->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
