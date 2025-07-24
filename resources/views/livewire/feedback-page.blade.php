<main>
    <section class="modern-feedback-section">
        <h2 class="modern-feedback-title">We Value Your Feedback</h2>
        <form wire:submit.prevent="submit" class="modern-feedback-form">
            <div class="modern-feedback-field">
                <label for="name">Your Name:</label>
                <input type="text" id="name" wire:model="name" required class="modern-feedback-input">
                @error('name') <span class="modern-feedback-error">{{ $message }}</span> @enderror
            </div>

            <div class="modern-feedback-field">
                <label for="email">Your Email:</label>
                <input type="email" id="email" wire:model="email" required class="modern-feedback-input">
                @error('email') <span class="modern-feedback-error">{{ $message }}</span> @enderror
            </div>

            <div class="modern-feedback-field">
                <label for="rating">Rating:</label>
                <select id="rating" wire:model="rating" required class="modern-feedback-input">
                    <option value="">Select</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
                @error('rating') <span class="modern-feedback-error">{{ $message }}</span> @enderror
            </div>

            <div class="modern-feedback-field">
                <label for="comments">Comments:</label>
                <textarea id="comments" wire:model="comments" rows="4" required class="modern-feedback-input"></textarea>
                @error('comments') <span class="modern-feedback-error">{{ $message }}</span> @enderror
            </div>

            <div class="modern-feedback-submit">
                <button type="submit" class="modern-btn modern-feedback-btn">Submit Feedback</button>
            </div>
        </form>

        @if (session()->has('success'))
            <div class="modern-feedback-success">
                {{ session('success') }}
            </div>
        @endif
    </section>
</main>
