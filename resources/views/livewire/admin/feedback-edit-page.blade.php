<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Edit Feedback</h2>

    @if(session()->has('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateFeedback">
        <div class="mb-6">
            <label for="name" class="block">Name:</label>
            <input type="text" id="name" wire:model="name" class="border p-2 w-full">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block">Email:</label>
            <input type="email" id="email" wire:model="email" class="border p-2 w-full">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="rating" class="block">Rating:</label>
            <select id="rating" wire:model="rating" class="border p-2 w-full">
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Terrible</option>
            </select>
            @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="comments" class="block">Comments:</label>
            <textarea id="comments" wire:model="comments" rows="4" class="border p-2 w-full"></textarea>
            @error('comments') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block">Status:</label>
            <select id="status" wire:model="status" class="border p-2 w-full">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="archived">Archived</option>
            </select>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update Feedback</button>
    </form>
</div>
