<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Feedback;

class AdminFeedbackPage extends Component
{
    public $feedbacks;

    public function mount()
    {
        $this->feedbacks = Feedback::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.admin-feedback-page')->layout('components.layouts.dashboard');
    }
}
