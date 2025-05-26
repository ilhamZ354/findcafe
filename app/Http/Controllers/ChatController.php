<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\CafeDetail;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    // menampilkan chat untuk user
    public function chatUser($toUserId)
    {
        // tandain terbaca dulu
        Chat::where('from_user_id', $toUserId)
            ->where('to_user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $cafe = User::where('id', $toUserId)->with('cafeDetail')->first();
        return view('pages.chat', ['cafe' => $cafe]);
    }



    // list chat user
    public function listChat()
    {
        $cafe_id = Auth::id();

        // Ambil semua user yang pernah mengirim pesan ke cafe
        $userIds = Chat::where('to_user_id', $cafe_id)
            ->distinct()
            ->pluck('from_user_id');

        // ambil seluruh user yang pernah chat cafe
        $users = User::whereIn('id', $userIds)
            ->with(['unreadMessages' => function ($query) use ($cafe_id) {
                $query->where('to_user_id', $cafe_id)
                    ->latest();
            }])
            ->get();


        return view('cafe.list-chat', ['users' => $users]);
    }


    // go to chat cafe
    public function chatCafe($toUserId)
    {
        // tandain terbaca dulu
        Chat::where('from_user_id', $toUserId)
            ->where('to_user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $user = User::where('id', $toUserId)->first();
        $cafe = CafeDetail::where('cafe_id', Auth::id())->first();
        return view('cafe.chat', ['user' => $user, 'cafe' => $cafe]);
    }
}
