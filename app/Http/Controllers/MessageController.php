<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $contact_id = $request->contact_id;
        return Message::select(
            'id',
            DB::raw("IF(from_id=$user_id,1,0) as written_by_me"),
            //(('from_id' == $user_id) ? 1 : 0) . ' as writen_by_me',
            'content',
            'created_at')
            ->where(function ($query) use ($user_id, $contact_id) {
                $query->whereFromId($user_id)->whereToId($contact_id);
            })
            ->orWhere(function ($query) use ($user_id, $contact_id) {
                $query->whereFromId($contact_id)->whereToId($user_id);
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    public function store(Request $request)
    {
        try {
            $message = new Message;
            $message->from_id = auth()->user()->id;
            $message->to_id = $request->to_id;
            $message->content = $request->content;
            $saved = $message->save();

            $data = [];
            $data['success'] = $saved;
            $data['message'] = $message;

            event(new MessageSend($message));
            return $data;

        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

    }

    public function show(Message $message)
    {
        //
    }

    public function edit(Message $message)
    {
        //
    }

    public function update(Request $request, Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        //
    }
}
