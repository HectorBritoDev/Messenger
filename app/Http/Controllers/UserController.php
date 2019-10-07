<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('profile');
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->name;

        if ($request->password) {
            $user->password = $request->password;
        }

        if ($request->hasFile('picture')) {
            $file = $request->picture;
            $path = public_path('/users');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $moved = $file->move($path, $fileName);
            $user->avatar = $fileName;
        }
        $user->save();
        return $user;

    }

    public function destroy(User $user)
    {
        //
    }
}
