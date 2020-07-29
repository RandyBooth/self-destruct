<?php

namespace App\Http\Controllers;

use App\Message;
use App\Rules\MessagePassword;
use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messages.index');
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
        $throttler = Throttle::get($request->instance(), 5, 1);

        if (!$throttler->check()) {
            abort(429);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'message' => [
                    'required',
                    // 'max:1000'
                ],
                'password' => [
                    'string',
                    'min:6',
                ],
            ],
            [],
        );

        if ($validator->passes()) {
            $message = Message::create(
                [
                    'body' => $request->message,
                    'password' => $request->password

                ]
            );

            $throttler->hit();
            return redirect()->route('home')->with('submitted', true);
        }

        return redirect()->back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $slug_password)
    {
        $message = $this->getMessage($slug, $slug_password, ['id', 'slug', 'slug_password', 'password', 'body']);

        if (! $message) {
            return view('messages.expired');
        }

        if (empty($message->password)) {
            return redirect()->route('message.hidden')->with('message_body', $message->body);
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
        $throttler = Throttle::get($request->instance(), 10, 5);

        if (!$throttler->check()) {
            abort(429);
        }

        $message = $this->getMessage($slug, $slug_password, ['id', 'slug', 'slug_password', 'password', 'body']);

        if (! $message) {
            return view('messages.expired');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    new MessagePassword($message->password),
                ],
            ]
        );

        if ($validator->passes()) {
            $throttler->clear();
            return redirect()->route('message.hidden')->with('message_body', $message->body);
        }

        $throttler->hit();

        return redirect()->back()->withErrors($validator);
    }

    private function getMessage($slug, $slug_password, $select = ['*'])
    {
        $message = Message::select($select)->slug($slug)->first();

        if ($message) {
            if ($message->checkSlugPassword($slug_password, $message->slug_password)) {
                return $message;
            }
        }

        $throttler = Throttle::get(['ip' => request()->ip(), 'route' => 'message'], 50, 1);

        if (!$throttler->check()) {
            abort(429);
        }

        $throttler->hit();
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
