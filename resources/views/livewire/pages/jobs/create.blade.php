<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create New Job Posting</h1>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8" wire:submit.prevent="submit"
            enctype="multipart/form-data">
            <!-- Job Details Section -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                <div class="mb-4">
                    <label for="jobTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="jobTitle" wire:model="title" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter job title">
                </div>
                <div class="mb-4">
                    <label for="jobDescription" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="jobDescription" wire:model="description" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter job description"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                        <input type="text" id="experience" wire:model="experience" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="e.g., 2-5 years">
                    </div>
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                        <input type="text" id="salary" wire:model="salary" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Enter salary details">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" id="location" wire:model="location" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="e.g., 2-5 years">
                    </div>
                    <div>
                        <label for="extraInfo" class="block text-sm font-medium text-gray-700">Extra Info</label>
                        <input type="text" id="extraInfo" wire:model="extra_info" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Full-name / details">
                    </div>
                </div>
            </div>

            <!-- Company Details Section -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Company Details</h2>
                <div class="mb-4">
                    <label for="companyName" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="companyName" wire:model="company_name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter company name">
                </div>
                <div class="mb-4">
                    <label for="companyLogo" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" id="companyLogo" wire:model="company_logo" accept="image/*"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-4">Skills</h2>
                    <select id="skills" wire:model="skills" multiple
                        class="mt-1 block w-full h-44 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @if ($allSkills && $allSkills->isNotEmpty())
                            @foreach ($allSkills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        @else
                            <option disabled>No skills available</option>
                        @endif
                    </select>

                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-span-1 md:col-span-2 flex justify-start">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>
