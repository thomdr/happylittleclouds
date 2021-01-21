<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Conversation;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    /**
     * Send chat message as visitor
     *
     * @param Request $request
     * @return void
     */
    public function visitorSend(Request $request)
    {
        // Validate IP & message
        $validator = Validator::make($request->all(), [
            'visitor_ip' => 'required|ip|max:255',
            'message' => 'required|max:1000'
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors());
        }
        // Get conversation, create if it does not exist
        $conversation = Conversation::where('visitor_ip', request()->visitor_ip)->first();
        if (is_null($conversation)) {
            Conversation::create([
                'visitor_ip' => request()->visitor_ip,
                'has_new_messages' => 1
            ]);
        }
        Message::create([
            'sender' => 'visitor',
            'message' => request()->message,
            'conversation_id' => $conversation->id
        ]);
        $conversation->update(['has_new_messages' => 1]);
        return;
    }

    /**
     * Retrieve chat messages as visitor
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function retrieveVisitor(Request $request)
    {
        $conversation = Conversation::where('visitor_ip', request()->visitor_ip)->first();
        return view('messages', [
            'messages' => is_null($conversation) ? [] : $conversation->messages,
            'perspective' => 'visitor'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('chat.admin', [
            'conversations' => Conversation::orderBy('updated_at', 'asc')->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Exhibition $exhibition
     * @return \Illuminate\Http\Response
     */
    public function employeeChat(Conversation $conversation)
    {
        return view('chat.chat', [
            'conversation' => $conversation
        ]);
    }

    /**
     * Send chat message as employee
     *
     * @param Request $request
     * @return void
     */
    public function employeeSend(Request $request)
    {
        // Validate IP & message
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|max:255',
            'message' => 'required|max:1000',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors());
        }
        // Get conversation, create if it does not exist
        $conversation = Conversation::find(request()->id);
        if (is_null($conversation)) {
            return redirect()->route('exhibitions.admin');
        }
        Message::create([
            'sender' => 'employee',
            'message' => request()->message,
            'conversation_id' => $conversation->id,
            'employee_id' => request()->employee_id
        ]);
        return;
    }

    /**
     * Retrieve chat messages as employee
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function retrieveEmployee(Request $request)
    {
        $conversation = Conversation::find(request()->id);
        $conversation->update(['has_new_messages' => 0]);
        return view('messages', [
            'messages' => $conversation->messages,
            'perspective' => 'employee'
        ]);
    }
}
