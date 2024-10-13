<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add students
        </h2>
    </x-slot>
    <div class="py-12">
        <div style="display:flex;justify-content: center;font-size:25px;">
            These are students that are not part of any classroom.
        </div>
        <div class="student-container">
            <div class="student-grid">
                @foreach($students as $student)
                    <div class="student-card">
                        <div class="student-info">
                            <div class="student-name">
                                {{ $student->name }}
                            </div>
                            <form action="{{ route('student.add', ['student' => $student->id ]) }}" method="POST" class="add-student-form">
                                @csrf
                                <button type="submit" class="add-button">
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                {{ $students->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .student-container {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .student-grid {
        width: 100%;
        max-width: 1300px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .student-card {
        background: #899499;
        margin: 10px;
        height: 150px;
        width: 150px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .student-info {
        display: flex;
        flex-direction: column;
        padding: 20px;
        height: 100%;
        justify-content: space-between;
    }

    .student-name {
        color: white;
        font-size: 15px;
        flex-grow: 1;
    }

    .add-button {
        background: green;
        width: 80px;
        height: 40px;
        border: none;
        color: white;
        cursor: pointer;
    }

    .add-button:hover {
        background: darkgreen;
    }

    .pagination {
        width: 50%;
        margin: 20px auto;
    }

</style>
