<div class="p-4 space-y-4">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('filament.admin.resources.student-grades.create') }}" 
           class="p-4 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-primary-100 rounded-lg">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Add New Grade</h3>
                    <p class="text-xs text-gray-500">Record a new grade for a student</p>
                </div>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.student-grades.index', ['tableFilters[created_at][from]' => now()->subDays(7)->toDateString()]) }}" 
           class="p-4 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-primary-100 rounded-lg">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Recent Grades</h3>
                    <p class="text-xs text-gray-500">View grades from the last 7 days</p>
                </div>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.student-grades.index', ['tableFilters[score][max]' => '60']) }}" 
           class="p-4 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-warning-100 rounded-lg">
                    <svg class="w-6 h-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Low Scores</h3>
                    <p class="text-xs text-gray-500">View students scoring below 60%</p>
                </div>
            </div>
        </a>

        <a href="#" onclick="window.print()" class="p-4 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-success-100 rounded-lg">
                    <svg class="w-6 h-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Print Report</h3>
                    <p class="text-xs text-gray-500">Generate a printable report</p>
                </div>
            </div>
        </a>
    </div>
</div> 