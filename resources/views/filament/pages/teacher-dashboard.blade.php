<x-filament-panels::page>
    <div class="space-y-6">
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="text-lg font-medium text-gray-900">My Courses</h2>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($this->getSubjects() as $subject)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-md font-medium text-gray-900">{{ $subject->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $subject->description }}</p>
                        <div class="mt-4">
                            <a href="{{ route('filament.admin.resources.student-grades.index', ['tableFilters[subject_id][value]' => $subject->id]) }}" 
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                View Grades
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page> 