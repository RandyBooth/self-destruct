<?php

namespace App\Http\Controllers;

use App\Expire;
use App\Note;
use App\Rules\NotePassword;
use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    private $_select;

    public function __construct()
    {
        $this->_select = [
            'id',
            'slug',
            'slug_password',
            'password',
            'body',
            'expired_at'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notes.index', ['expires' => Expire::plucked()]);
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
                'note' => [
                    'required',
                    // 'max:1000'
                ],
                'password' => [
                    'present',
                    'nullable',
                    'string',
                    'min:6',
                ],
                'expiration' => [
                    'present',
                    'nullable',
                    'integer',
                ],
            ],
            [],
        );

        if ($validator->passes()) {
            $note = Note::create(
                [
                    'body' => $request->note,
                    'password' => $request->password,
                    'expired_at' => ($request->expiration)
                        ? now()->addHours($request->expiration)
                        : null,
                ]
            );

            $throttler->hit();

            return redirect()
                ->route('home')
                ->with(
                    'link',
                    route(
                        'note.show',
                        [
                            'slug' => $note->slug,
                            'slug_password' => $note->slug_password,
                        ]
                    )
                );
        }

        $filtered = Arr::except($request->all(), ['_token', 'note']);
        $show_options = false;

        foreach ($filtered as $data) {
            if (!is_null($data)) {
                $show_options = true;
                break;
            }
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with(compact('show_options'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $slug_password = null)
    {
        $note = $this->getNote($slug, $slug_password, $this->_select);

        if (! $note) {
            return view('notes.expired');
        }

        if (empty($note->password)) {
            $note->delete();

            return redirect()->route('note.hidden')->with('note_body', $note->body);
        }

        return view('notes.password', compact('slug', 'slug_password'));
    }

    public function hidden()
    {
        if (session()->has('note_body')) {
            return view('notes.show', ['note_body' => session()->pull('note_body')]);
        }

        return view('notes.expired');
    }

    public function password(Request $request, $slug, $slug_password)
    {
        $throttler = Throttle::get($request->instance(), 10, 5);

        if (!$throttler->check()) {
            abort(429);
        }

        $note = $this->getNote($slug, $slug_password, $this->_select);

        if (! $note) {
            return view('notes.expired');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    new NotePassword($note->password),
                ],
            ]
        );

        if ($validator->passes()) {
            $throttler->clear();
            $note->delete();

            return redirect()->route('note.hidden')->with('note_body', $note->body);
        }

        $throttler->hit();

        return redirect()->back()->withErrors($validator);
    }

    private function getNote($slug, $slug_password, $select = ['*'])
    {
        $note = Note::select($select)->slug($slug)->first();

        if ($note) {
            if ($note->checkSlugPassword($slug_password, $note->slug_password)) {
                return $note;
            }
        }

        $throttler = Throttle::get(['ip' => request()->ip(), 'route' => 'note'], 50, 1);

        if (!$throttler->check()) {
            abort(429);
        }

        $throttler->hit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
