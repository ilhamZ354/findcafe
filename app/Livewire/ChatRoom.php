<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatRoom extends Component
{
    public $messages = [];
    public $messageText = '';
    public $toUserId;

    protected $listeners = ['refreshMessages' => 'getMessages'];

    public function mount($toUserId)
    {
        $this->toUserId = $toUserId;
        $this->getMessages();
    }

    public function getMessages()
    {
        $this->messages = Chat::where(function($q) {
                $q->where('from_user_id', Auth::id())
                  ->where('to_user_id', $this->toUserId);
            })
            ->orWhere(function($q) {
                $q->where('from_user_id', $this->toUserId)
                  ->where('to_user_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();
    }

    public function sendMessage()
    {
        if (!$this->messageText) return;

        Chat::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->toUserId,
            'message' => $this->messageText,
        ]);

        $this->messageText = '';
        $this->getMessages();

        $this->emitTo('notification-bell', 'newMessageReceived');
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
