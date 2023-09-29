<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{

    public function loadDashboard()
    {
        if (Auth::user()) {
            $conversation = Conversation::with(['user', 'users', 'message'])->where('receiver_id', auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            
            $unreadCounts = Message::where('receiver_id', auth()->id())
                ->where('read', 0)
                ->select('sender_id', DB::raw('count(*) as unread_count'))
                ->groupBy('sender_id')
                ->get();

            // Create an associative array to map sender_id to unread_count
            $unreadCountsMap = $unreadCounts->pluck('unread_count', 'sender_id')->toArray();

            return view('auth.dashboard', compact('conversation', 'unreadCountsMap'));
        }
        return redirect('/');
    }



    public function last_check($message, $id)
    {
        $conversation = Conversation::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', auth()->user()->id);
        })->firstOrNew();

        $conversation->message_id = $message->id;
        $conversation->created_at = now();
        $conversation->save();
    }

    public function message_view($id)
    {
        $user = User::where('id', $id)->first();
    
        $message = Message::where(function ($query) use ($id) {
            $query->where(function ($subquery) use ($id) {
                $subquery->where('receiver_id', auth()->user()->id)
                    ->where('sender_id', $id);
            })->orWhere(function ($subquery) use ($id) {
                $subquery->where('receiver_id', $id)
                    ->where('sender_id', auth()->user()->id);
            });
        })
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($message as $messages) {
            if ($messages->receiver_id == auth()->user()->id)
                $messages->update([
                    'read' => '1',
                ]);
        };
        // dd($message);
        return view('message.message_view', compact('message', 'user', 'id',));
    }


    public function send_msg(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image'
            ]); 
            $image = $request->file('image')->store('public/message_image');
            $message =   Message::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'image'=>$image,
                'message' => $request->message,
            ]);
            $this->last_check($message, $id);
            return back();
        }
        else{
            $request->validate([
                'message' => 'required',
            ]);
    
            $message =   Message::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'message' => $request->message,
            ]);
    
            $this->last_check($message, $id);
            return back();
        }
       
    }



    public function chat_new()
    {
        $user = User::where('id', '!=', auth()->user()->id)->orderBy('created_at')->paginate(10);
        return view('message.chat_new', compact('user'));
    }



    public function update_chat(Request $request)
    {

        $id = Message::where('id', $request->message_id)->first();
        $request->validate([
            'message' => 'required'
        ]);

        $id->update([
            'message' => $request->message,
        ]);
        return back();
    }
    public function delete_chat(Message $id)
    {
        if($id->image){
            Storage::delete($id->image);
        }
        $id->delete();
        return back();
    }
}
