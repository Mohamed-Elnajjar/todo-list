<?php

/*
    1. How to add key to table with used commend
        => add_image_to_posts
    2. used create folder inside view because organize
    3. compact() == with()
        => such
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    4. count() == sizeof()

    5. Store
        => public function createPost(Request $request){
        $post = Post::create( $request->all() ); // with api

        if you want value default
        <input type="hidden" name="active" value="1"> or used default() in migrations or add manualy

        $post = Post::create([
            'title' => 'My Awesome Post',
            'body' => 'This is the body of my post',
            'active' => 1
        ]);


        $post = new Post;
        $post->title = 'My Awesome Post';
        $post->body = 'This is the body of my post';
        $post->active = 1;
        $post->save();

        you can selected fillable
        protected $fillable = ['title', 'body', 'active'];

        all fillable
        protected $guarded = [];

        protected $table = 'posts';

        6. method storeAs() vs move()
            storeAs() => storage/app
            move() => public

        7. nullable used image
            => in key in folder migrations or validate

        8. method name() used in file web.php
            => Route::post('/posts',[PostsController::class,'store'])->name('posts')
			=> name() used route();


    9. How to used validation and handler message errors

    $validator = Validator::make($request->all(), [
        '' => ['','','']
    ])

    if($validator->fails()){
        return redirect('/posts')->withErrors($validator)
    }


    $this->validate($request,[
        '' => ['','','']
    ])


    $request->validate([
        '' => ['','','']
    ])

    $validated = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    $request->validate([
    'title' => 'required|unique:posts|max:255',
    'body' => 'required',
    'publish_at' => 'nullable|date',
    ]);




        ->withErrors($validator)


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


or




<input id="title"
    type="text"
    name="title"
    class="@error('title') is-invalid @enderror">

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror




php artisan make:request StorePostRequest
    => create file in App\Http\Requests
public function rules()
{
    return [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ];
}

public function store(StorePostRequest $request)
{
    // The incoming request is valid...

    // Retrieve the validated input data...
    $validated = $request->validated();

    // Retrieve a portion of the validated input data...
    $validated = $request->safe()->only(['name', 'email']);
    $validated = $request->safe()->except(['name', 'email']);
}


The URI that users should be redirected to if validation fails.
protected $redirect = '/dashboard';

The route that users should be redirected to if validation fails.
protected $redirectRoute = 'dashboard';



10 . How to upload image

    if($request->hasFile('image')){
        $imageExtension = $request->file('image')->getClientOriginalExtension();
        $imageName = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($imageName,PATHINFO_FILENAME);
        $imageName2 = $fileName .'_' . '.' . $imageExtension
        $path = 'images/posts';
        // upload image in public
        $request->file('image')->move($path,$imageName2);
        // upload image in storage/app
        $request->file('image')->storeAs($path,$imageName2);

    }else{
        $imageName2 = 'noImage.jpg';
    }
    $store = new Post();
    $store->image = $request->input("$imageName2");




    11. you can create two controller in same line

    Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);




    12. you can used link deferent
    use App\Http\Controllers\CommentController;

    Route::resource('photos.comments', CommentController::class)->shallow();

    GET	/photos/{photo}/comments	                       index	          photos.comments.index
    GET	/photos/{photo}/comments/create	          create  	          photos.comments.create
    POST	/photos/{photo}/comments	                 store	             photos.comments.store
    GET	/comments/{comment}	                            show	            comments.show
    GET	/comments/{comment}/edit	                   edit	               comments.edit
    PUT/PATCH	/comments/{comment}	          update	          comments.update
    DELETE	/comments/{comment}	                 destroy	          comments.destroy


    13. you can used return redirect() or view()

    14. @method() == {{method_field()}}


    15. relation Models
        => return $this->hasMany('App\Models\Post'); or return $this->hasMany(Post::class);
		=> return $this->belongisTo('App\Models\User'); or return $this->belongisTo(User::class);

    16. How to take user that login id
        => auth()->user()->id; or Auth::user()->id   => use Illuminate\Support\Facades\Auth;


    17. Middleware
        => is rules
        => create middleware
        php artisan make:middleware CheckUser
        => then => register middleware in file kernel.php select $routeMiddleware if you work with file web.php
        'check_user' => \App\Http\Middleware\CheckUser::class,
        => then => relation with file Route and requests
        ->middleware('check_user'); or \App\Http\Middleware\CheckUser::class

    18. what is file middleware
        => it is work with requests and Routes and links
        => inside file middleware found 3 middleware
        1. $middleware
        2. $middlewareGroups => with web and api
        3. $routeMiddleware => with routes

        => public function handle(Request $request, Closure $next)
        {
            return $next($request);
        }
            => parameters used request and next
            => return $next($request); next function normal

        => what is => return response("Mohamed Amen");
        return response("Mohamed Amen") is echo "Mohamed Amen"
        return is response and function is request


        => public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    => we used __construct to work on all functions



    // Groupe
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


    ->middleware(['',''])
    ->middleware(['web'])


    used method name() to used with method route(name)
	
	19. after end of functions Controller 
		=> used public function __construct () {
			 // select any function run if someone is user login
			 $this->middelware('auth',['except' => ['index']]);
		}
		
		
		
		
		=> add_user_id_tp_posts
		    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
	
*/