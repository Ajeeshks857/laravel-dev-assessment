<div>
    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
            {{-- Add button for creating a new skill --}}
            <button wire:click="createSkillForm" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Skill</button>
        </div>

        {{-- Create New Skill Form --}}
        @if ($creatingSkill)
            <div class="mt-6 bg-gray-100 p-4 rounded">
                <h2 class="text-xl font-bold">Create New Skill</h2>
                <form wire:submit.prevent="createSkill">
                    <div class="mt-4">
                        <label for="name" class="block">Skill Name</label>
                        <input type="text" id="name" class="border p-2 w-full" wire:model="skillName"
                            required />
                    </div>

                    <div class="mt-4">
                        <label for="status" class="block">Status</label>
                        <select id="status" class="border p-2 w-full" wire:model="skillStatus" required>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Skill</button>
                        <button type="button" wire:click="$set('creatingSkill', false)"
                            class="ml-4 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        @endif

        {{-- Skills Table --}}
        <div class="mt-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Skill</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $skill)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $skill->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <button wire:click="editSkill({{ $skill->id }})"
                                    class="text-blue-500 hover:underline">Edit</button>
                                <button wire:click="deleteSkill({{ $skill->id }})"
                                    class="text-red-500 hover:underline ml-4">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
