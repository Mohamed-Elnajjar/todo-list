<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    public function index()
    {
        // $posts = Auth::user()->posts;
		if(auth()->user()){
			$user_id = Auth::user()->id;
			$posts = Post::where('user_id', $user_id)->get();
			return view('posts.index')->with('posts', $posts);
		}
        return view("layouts.app_someone");
		
        // $posts = Post::all();
        // echo ($posts);
        // echo "<br>";

        // $user_id = Auth::user()->id;
        // $posts = Post::all(); // DB::table('users')->where('votes', '>', 100)->get();
        // $arr = [];
        // foreach ($posts as $post) {
        //     if ($post->user_id == $user_id) {
        //         $arr[] = $post;
        //     }
        // }
        // return view('posts.index')->with('posts', $arr);
        
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => 'required',
            'image' => ['required', 'nullable', 'max:2000'] // max is size image kb
        ]);

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . '.' . $imageExtension;
            // $imageName2 = $request->file('image')->getClientOriginalName();
            // $fileName = pathinfo($imageName2, PATHINFO_FILENAME);
            $path = 'images/posts';
            $request->file('image')->move($path, $imageName);
            // $request->file('image')->storeAs($path, $imageName);
        } else {
            $imageName = 'noimage.jpg';
        }

        $store = new Post();
        $store->image = $imageName;
        $store->title = $request->input('title');
        $store->body = $request->input('body');
        $store->user_id = auth()->user()->id;
        $store->save();
        return redirect('/posts')->with('success', 'Success Create Post');
    }

    public function show($id)
    {
        $show = Post::find($id);
        return view('posts.show')->with('show', $show);
    }

    public function edit($id)
    {
        $edit = Post::find($id);
        return view('posts.edit')->with('edit', $edit);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => ['required', 'nullable', 'max:2000'] // max is size image kb
        ]);

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . '.' . $imageExtension;
            $path = 'images/posts';
            $request->file('image')->move($path, $imageName);
        } else {
            $imageName = 'noImage.jpg';
        }
        $update = Post::find($id);
        $update->image = $imageName;
        $update->title = $request->input('title');
        $update->body = $request->input('body');
        $update->save();
        return redirect('/posts')->with('warning', 'Success Update Post');
    }

    public function destroy($id)
    {
        $delete = Post::find($id);
        if (auth()->user()->id !== $delete->user_id) {
            return redirect('/posts')->with('error_authentication', '');
        } else {
            if ($delete != null) {
                $delete->delete();
                return redirect('/posts')->with('danger', 'success Delete Post');
            }
        }
    }
}