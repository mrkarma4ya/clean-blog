<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
        abort('404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($username)
    {
        //
        $user = User::where('username', $username)->firstOrFail();
        $posts = User::where('username', $username)->firstOrFail()->posts()->orderBy('created_at', 'desc')->paginate(5);
        return view('users.show')
            ->with('user', $user)
            ->with('posts', $posts);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        //
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user() != $user) {
            abort('401');
        }

        return view('admin.users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        request()->validate([
            'name' => 'required',
            'email' => 'email|required',
            'quote' => 'max:500',
            'about' => 'max:500',
            'cover_image' => 'nullable|image|max:5120', //Can be empty, must be image, max image size = 5120kb    
            'avatar' => 'nullable|image|max:5120', //Can be empty, must be image, max image size = 5120kb  
            'password' => 'nullable|min:8|confirmed'
        ]);

        //Prevent Duplicate email entries
        if ($request->email != $user->email) {
            request()->validate([
                'email' => 'unique:App\User,email'
            ]);
        }

        $user->name = request('name');
        $user->email = request('email');
        $user->quote = request('quote');
        $user->about = request('about');
        if($request->has('password')){
            $user->password = Hash::make($request->password); 
        }

        
        if ($request->hasFile('cover_image')) {
            $coverImage = ($this->generateImageFileName($request->file('cover_image'), 'users'));
            $request->file('cover_image')->storeAs('public', $coverImage); //Upload Cover Image
            $user->cover_image = $coverImage; //Write to DB
        }

        
        if ($request->hasFile('avatar')) {
            $avatar = ($this->generateImageFileName($request->file('avatar'), 'users'));
            $request->file('avatar')->storeAs('public', $avatar); //Upload Avatar
            //dd($avatar);
            $resizedAvatar = Image::make('storage/'.$avatar)->fit(600); //resize to 600x600
            $resizedAvatar->save();
            $user->avatar = $avatar; //Write to DB
        }

        $user->save();

        return back()
            ->with('success', 'User Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
