In Laravel, there are several basic functions and helpers that are frequently used. Here’s a list of some essential ones:

1. Routes and Controllers
Basic Route Definition:

Route::get('/welcome', function () {
    return view('welcome');
});


Route to Controller Method:

Route::get('/users', [UserController::class, 'index']);


Named Routes:

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');


Redirect Route:

Route::redirect('/here', '/there');



2. Request and Response
Getting Input Data:

$input = $request->input('name');
$all = $request->all();


JSON Response:

return response()->json(['message' => 'Success'], 200);


Redirect with Data:

return redirect()->route('profile.show')->with('status', 'Profile updated!');



3. Database Query Builder
Basic Query:

$users = DB::table('users')->get();


Where Clause:

$activeUsers = DB::table('users')->where('status', 'active')->get();


Insert Data:

DB::table('users')->insert(['name' => 'John', 'email' => 'john@example.com']);


Update Data:

DB::table('users')->where('id', 1)->update(['name' => 'Jane']);



4. Eloquent ORM (Models)
Retrieving All Records:

$users = User::all();


Finding a Record by ID:

$user = User::find(1);


Where Clause with Eloquent:

$activeUsers = User::where('status', 'active')->get();


Creating a New Record:

User::create(['name' => 'John', 'email' => 'john@example.com']);


Updating a Record:

$user = User::find(1);
$user->name = 'Jane';
$user->save();



5. Blade Templating
Displaying Variables:

<h1>Hello, {{ $name }}</h1>


If Statement:

@if($user->isAdmin())
    <p>Admin User</p>
@endif


Loop:

@foreach($users as $user)
    <p>{{ $user->name }}</p>
@endforeach



6. Common Helper Functions
URL and Asset Helpers:

url('/home'); // Generate URL
asset('css/style.css'); // Generate asset URL


Old Input Value:

old('email'); // Retrieve old input value


Session Helpers:

session(['key' => 'value']);
session()->get('key');


Config Helper:

config('app.timezone'); // Get config value



7. File Storage
Uploading a File:

$path = $request->file('photo')->store('photos');


Accessing Files:

Storage::disk('local')->get('file.txt');



8. Validation
Basic Validation:

$validated = $request->validate([
    'title' => 'required|max:255',
    'body' => 'required',
]);


Custom Error Messages:

$request->validate([
    'title' => 'required|max:255',
], [
    'title.required' => 'The title is mandatory.',
]);



9. Authentication
Checking Authentication:

if (Auth::check()) {
    // User is logged in
}


Retrieving the Authenticated User:

$user = Auth::user();


Logging Out:

Auth::logout();



10. Artisan Commands
Running Migrations:

php artisan migrate


Clearing Cache:

php artisan cache:clear


Serving the Application:

php artisan serve