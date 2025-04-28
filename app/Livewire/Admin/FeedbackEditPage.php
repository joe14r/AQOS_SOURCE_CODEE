<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Feedback;

class FeedbackEditPage extends Component
{
    public $feedback;
    public $name, $email, $rating, $comments, $status;

    // Initialize the feedback data
    public function mount($feedbackId)
    {
        $this->feedback = Feedback::find($feedbackId);

        if ($this->feedback) {
            $this->name = $this->feedback->name;
            $this->email = $this->feedback->email;
            $this->rating = $this->feedback->rating;
            $this->comments = $this->feedback->comments;
            $this->status = $this->feedback->status;
        }
    }

    // Update feedback
    public function updateFeedback()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'comments' => 'required|string',
            'status' => 'required|string|in:pending,approved,archived', // example status values
        ]);

        $this->feedback->update([
            'name' => $this->name,
            'email' => $this->email,
            'rating' => $this->rating,
            'comments' => $this->comments,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Feedback updated successfully!');
        return redirect()->route('admin.feedback');
    }

    // Render the view
    public function render()
    {
        return view('livewire.admin.feedback-edit-page')->layout('components.layouts.dashboard');
    }
}
