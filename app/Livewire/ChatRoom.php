<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatRoom extends Component
{
    public $messages = [];
    public $messageText = '';
    public $toUserId;
    public $cafeImage;
    public int $messageKey = 0;

    #[On('refreshMessages')]
    public function getMessages()
    {
        $chats = Chat::with('sender')
            ->where(function ($q) {
                $q->where('from_user_id', Auth::id())
                    ->where('to_user_id', $this->toUserId);
            })
            ->orWhere(function ($q) {
                $q->where('from_user_id', $this->toUserId)
                    ->where('to_user_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get()
            ->values(); // pastikan indexnya rapi

        // Ubah ke array sederhana agar perubahan bisa dideteksi Livewire
        $this->messages = $chats->map(function ($msg) {
            return [
                'id' => $msg->id,
                'message' => $msg->message,
                'is_mine' => $msg->from_user_id === Auth::id(),
                'time' => $msg->created_at->format('H:i'),
            ];
        })->toArray();
    }

    public function mount($toUserId, $cafeImage)
    {
        $this->toUserId = $toUserId;
        $this->cafeImage = $cafeImage;
        $this->getMessages();
    }

    public function sendMessage()
    {
        if (trim($this->messageText) === '') return;

        Chat::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->toUserId,
            'message' => $this->messageText,
        ]);

        // $this->reset('messageText');
        $this->messageText = '';
        $this->messageKey++;
        $this->getMessages();

        // Scroll ke bawah setelah kirim pesan
        $this->dispatch('messageSent');
    }

    public function render()
    {
        return view('livewire.chat-room', [
            'cafeImage' => $this->cafeImage
        ]);
    }
}
