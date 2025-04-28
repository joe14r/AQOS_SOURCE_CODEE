<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedback;

class FeedbackPage extends Component
{
    public $name;
    public $email;
    public $rating;
    public $comments;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'required|string',
        ]);

        Feedback::create([
            'name' => $this->name,
            'email' => $this->email,
            'rating' => $this->rating,
            'comments' => $this->comments,
            'status' => 'pending', // or any default status you use
        ]);

        session()->flash('success', 'Thank you for your feedback!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.feedback-page');
    }
}
