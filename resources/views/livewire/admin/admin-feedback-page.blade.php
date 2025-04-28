<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Feedback List</h2>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Rating</th>
                <th class="border p-2">Comments</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $feedback)
                <tr>
                    <td class="border p-2">{{ $feedback->name }}</td>
                    <td class="border p-2">{{ $feedback->email }}</td>
                    <td class="border p-2">{{ $feedback->rating }}</td>
                    <td class="border p-2">{{ $feedback->comments }}</td>
                    <td class="border p-2">{{ ucfirst($feedback->status) }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.feedback-edit', $feedback->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-4 text-center text-gray-500">No feedback yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
