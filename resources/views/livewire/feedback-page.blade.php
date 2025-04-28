<section class="feedback-form">
    <form wire:submit.prevent="submit">
        <label for="name">Your Name:</label>
        <input type="text" id="name" wire:model="name" required>
        @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror

        <label for="email">Your Email:</label>
        <input type="email" id="email" wire:model="email" required>
        @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror

        <label for="rating">Rating:</label>
        <select id="rating" wire:model="rating" required>
            <option value="">Select</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Good</option>
            <option value="3">3 - Average</option>
            <option value="2">2 - Poor</option>
            <option value="1">1 - Terrible</option>
        </select>
        @error('rating') <span class="error text-red-500">{{ $message }}</span> @enderror

        <label for="comments">Comments:</label>
        <textarea id="comments" wire:model="comments" rows="4" required></textarea>
        @error('comments') <span class="error text-red-500">{{ $message }}</span> @enderror

        <button type="submit" class="btn">Submit Feedback</button>
    </form>

    @if (session()->has('success'))
        <div class="text-green-600 mt-2">
            {{ session('success') }}
        </div>
    @endif
</section>
