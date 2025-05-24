<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $unreadCount = 0;

    protected $listeners = ['newMessageReceived' => 'checkUnread'];

    public function mount()
    {
        $this->checkUnread();
    }

    public function checkUnread()
    {
        $this->unreadCount = Chat::where('to_user_id', Auth::id())
            ->where('is_read', false)
            ->count();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
