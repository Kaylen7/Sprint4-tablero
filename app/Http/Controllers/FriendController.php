<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\FriendRequestSent;
use App\Events\FriendRequestAccepted;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FriendController extends Controller
{
    use AuthorizesRequests;

    public function index(){

        $user = auth()->user();
        $friends = $user->getFriends();
        return view('friends.index')->with('friends', $friends);
    }

    public function add(Request $request){
        $friendId = $request->input('friend_id');
        try {
            $user = auth()->user();
            $friend = User::findOrFail($friendId);
            $user->addFriend($friend);
            
            FriendRequestSent::dispatch($user, $friend);
            return redirect()->route('friends.index')->with('message', 'Friend request sent!');

        }catch (\Exception $e){
            return redirect()->route('friends.index')->with('message', $e->getMessage());
        }
    }

    public function accept(Request $request){
        $senderId = $request->input('sender_id');
        $notificationId = $request->input('notification_id');
        $status = $request->input('status');
        $message = '';
        try {
            $user = auth()->user();
            $sender = User::findOrFail($senderId);
            $modified = $user->changeFriendRequestStatus($senderId, $status);
            if($modified){
                if($status === 'accepted'){
                    FriendRequestAccepted::dispatch($user, $sender);
                    $message = 'Friend request accepted';
                    $notification = $user->notifications()->find($notificationId)->delete();
                } else{
                    $message = 'User blocked';
                    $notification = $user->notifications()->find($notificationId)->delete();
                }
            }
            
            return back()->with('message', $message);
        } catch (\Exception $e){
            throw new \Exception($e);
        }
    }

    public function destroy(Request $request){
        $user = auth()->user();
        $senderId = $request->input('sender_id');
        $notificationId = $request->input('notification_id');
        if($notificationId){
            $user->removeNotification($notificationId);
        }
        $user->removeFriendRequest($senderId);
        return back()->with('message', 'User removed from friends.');
    }
}
