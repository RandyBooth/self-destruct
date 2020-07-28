<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $slug_password)
    {
        $message = $this->getMessage($slug, $slug_password);

        if (empty($message->password)) {
            session()->flash('message_body', $message->body);
            return redirect('hidden');
        }

        return view('messages.password', compact('slug', 'slug_password'));
    }

    public function hidden()
    {
        if (session()->has('message_body')) {
            return view('messages.show', ['message_body' => session()->pull('message_body')]);
        }

        return view('messages.expired');
    }

    public function password(Request $request, $slug, $slug_password)
    {
        if ($request->has('password')) {
            $message = $this->getMessage($slug, $slug_password);

            if (Hash::check($request->password, $message->password)) {
                session()->flash('message_body', $message->body);
                return redirect()->route('message.hidden');
            }
        }

        return redirect()->back();
    }

    private function getMessage($slug, $slug_password)
    {
        $message = Message::slug($slug)->first();

        if ($message) {
            if ($message->checkSlugPassword($slug_password, $message->slug_password)) {
                return $message;
            }
        }

        return view('messages.expired');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
