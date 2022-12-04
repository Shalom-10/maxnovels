<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookSearch;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleOauthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WriterForm;
use App\Http\Controllers\Writer;
use App\Http\Controllers\Bookmark;
use App\Http\Controllers\Avatar;
use App\Http\Controllers\SearchCollection;
use App\Http\Controllers\CollectionSearch;
use App\Http\Controllers\CollectionCRUD;
use App\Http\Controllers\BookCRUD;
use App\Http\Controllers\UserSearch;
use App\Http\Controllers\UserCRUD;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Middleware\Signin;
// use App\Http\Controllers;
use App\Models\User;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Category;
use App\Models\TargetAudience;
use App\Models\Copyright;
use App\Models\Rating;
use App\Models\Bookmark as BookmarkModel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('phpinfo', fn () => phpinfo());

Route::middleware(['guest'])->group( function () {

        Route::get('/login', function () {
            return view('login');
        })->name('login');

        Route::post('/login', [LoginController::class, 'login']);
    
        Route::get('/signup', function () {
            return view('signup');
        });
    
        Route::post('/signup', [UserController::class, 'store']);
    
        Route::get('/auth/google', function () {
            return Socialite::driver('google')->redirect();
        });
    
        Route::get('google/callback', [GoogleOauthController::class, 'create']);
    
        Route::get('/oauth/get_details', function () {
            if(session()->has('oauth_data'))
                return view('oauth');
            else return redirect('/signup');
        });
    
        Route::post('/oauth/get_details', [GoogleOauthController::class, 'store']);
    
        Route::get('/auth/facebook', function () {
            return Socialite::driver('facebook')->redirect();
        });
    
        Route::get('facebook/callback', [UserController::class, 'facebook']);

});

Route::middleware(['auth' , 'verified'])->group(function () {
    Route::get('/reader/{book}/{chapter}', function ($book, $chapter) {

        if(Read::create([
            'user_id' => auth()->user()->id,
            'book_id' => $book->id
        ])){}

        $book = Book::whereRelation('chapters', 'state', 'published')->where('id', $book)->first();


        if($book == null) return redirect('/books');

        $chapter = Chapter::where('book_id', $book->id)->where('order', $chapter)->where('state', 'published')->first();

        if($chapter == null) return redirect('/books');

        $next = Chapter::where('book_id', $book->id)->where('order', '>', $chapter->order)->orderBy('order', 'ASC')->first();
        $prev = Chapter::where('book_id', $book->id)->where('order', '<', $chapter->order)->orderBy('order', 'DESC')->first();

        if($next == null) $next = $chapter->order;
        else $next = $next->order;

        if($prev == null) $prev = $chapter->order;
        else $prev = $prev->order;

        $bookmark = BookmarkModel::where('user_id', auth()->user()->id)->where('chapter_id', $chapter->id)->first();

        $bookmark = $bookmark == null? false : true;

        return view('reader', [
            'book' => $book,
            'chapter' => $chapter,
            'next' => $next,
            'prev' => $prev,
            'bookmark' => $bookmark
        ]);
    });

    Route::get('/reader/{book}', function ($book) {

        if(Read::create([
            'user_id' => auth()->user()->id,
            'book_id' => $book->id
        ])){}

        $book = Book::whereRelation('chapters', 'state', 'published')->where('id', $book)->first();


        if($book == null) return redirect('/books');


        $chapter_id = BookmarkModel::where('user_id', auth()->user()->id)->where('book_id', $book->id)->first();

        if($chapter_id == null) {
            $chapter_id = Chapter::where('book_id', $book->id)->orderBy('order', 'ASC')->where('state', 'published')->first()->order;
        }
        else {
            $chapter_id = Chapter::where('book_id', $book->id)->where('id', $chapter_id->chapter_id)->where('state', 'published')->first()->order;

        }

        $chapter = Chapter::where('book_id', $book->id)->where('order', $chapter_id)->where('state', 'published')->first();

        if($chapter == null) return redirect('/books');

        $next = Chapter::where('book_id', $book->id)->where('order', '>', $chapter->order)->orderBy('order', 'ASC')->first();
        $prev = Chapter::where('book_id', $book->id)->where('order', '<', $chapter->order)->orderBy('order', 'DESC')->first();

        if($next == null) $next = $chapter->order;
        else $next = $next->order;

        if($prev == null) $prev = $chapter->order;
        else $prev = $prev->order;

        $bookmark = BookmarkModel::where('user_id', auth()->user()->id)->where('chapter_id', $chapter->id)->first();

        $bookmark = $bookmark == null? false : true;

        return view('reader', [
            'book' => $book,
            'chapter' => $chapter,
            'next' => $next,
            'prev' => $prev,
            'bookmark' => $bookmark
        ]);
    });

    Route::post('/bookmark', [Bookmark::class, 'bookmark']);
    Route::post('/unbookmark', [Bookmark::class, 'unbookmark']);
    
    Route::get('/preview/{book}', function (Book $book) {
    
        $related_books = Book::whereRelation('chapters', 'state', 'published')->limit(15)
                            ->where('category_id', $book->category_id)
                            ->where('title', '!=', $book->title)
                            ->get();
    
        return view('preview', [
            'book' => $book,
            'related_books' => $related_books,
        ]);
    });
    
    Route::get('/writeform', function () {

        return view('writeform', [
            'categories' => Category::all(),
            'audiences' => TargetAudience::all(),
            'copyrights' => Copyright::all(),
            'ratings' => Rating::all(),
            'book' => [],
            'type' => '',
        ]);
    });

    Route::get('/writeform/{book}', function (Book $book) {

        // dd();

        return view('writeform', [
            'categories' => Category::all(),
            'audiences' => TargetAudience::all(),
            'copyrights' => Copyright::all(),
            'ratings' => Rating::all(),
            'book' => $book,
            'type' => $book->type,
        ]);

    });

    Route::get('/writeform/new/{type}', function ($type) {

        // dd();

        return view('writeform', [
            'categories' => Category::all(),
            'audiences' => TargetAudience::all(),
            'copyrights' => Copyright::all(),
            'ratings' => Rating::all(),
            'book' => [],
            'type' => $type,
        ]);

    });

    Route::post('/writeform', [WriterForm::class , 'newbook']);
    
    Route::get('/writer/{book}/{chapter}', [Writer::class, 'writer']);
    Route::post('/writer/{book}/{chapter}', [Writer::class, 'save']);
    
    Route::post('/update_avatar', [Avatar::class , 'upload']);

    Route::get('/yourbooks', function () {

        $book = Book::where('author_id', session('user')['id'])->get();
        $book = $book->toArray();


        if($book == []) {
            return redirect('/writeform');
        }

        $books = Book::where('author_id', session('user')['id'])->paginate(5);
        return view('yourbooks', [
            'books' => $books
        ]);
    });
    

    Route::get('/chapters/{book}', [Writer::class, 'chapters']);
    Route::post('/chapters/{book}', [Writer::class, 'publishall']);

    Route::post('/sortchapters', [Writer::class, 'sortchapters']);

    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::get('/search_your_books', [BookSearch::class, 'your_book_search']);

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', function () {
            $users = User::select("*")
                    ->whereNotNull('last_seen')
                    ->orderBy('last_seen', 'DESC')
                    ->limit(10)->get();
        
            // dd(Book::all()->countBy('category_id'));
        
            $category_stat = Category::withCount('reads as reads')->get();
        
            $books = Book::withCount('reads as reads')->with('author')->orderBy('reads', 'DESC')->limit(10)->get();
        
            $reads = 0;
        
            Book::withCount('reads as reads')->get()->map(function ($book) use($reads) {
                $reads += $book->reads;
            });
        
            return view('admin', [
                'users' => $users,
                'total_users' => User::count(),
                'total_books' => Book::count(),
                'total_authors' => Book::all()->groupBy('author_id')->count(),
                'total_reads'  => $reads,
                'category_stat' => $category_stat,
                'books'         => $books,
            ]);
        });
        
        Route::get('/admin_books', function () {
            $books = Book::withCount('reads as reads')->with('author')->paginate(5);
            return view('adminbooks', [
                'books' => $books,
            ]);
        });
        
        Route::get('/adminbook_search', [BookSearch::class, 'admin_books']);
        Route::get('/admincollection_search', [CollectionSearch::class, 'admin_search']);
        Route::get('/adminuser_search', [UserSearch::class, 'admin_search']);
        
        
        Route::post('/update_collection', [CollectionCRUD::class, 'update']);
        Route::post('/delete_collection', [CollectionCRUD::class, 'delete']);
        Route::post('/delete_book', [BookCRUD::class, 'delete']);
        
        
        Route::get('/admin_book', function () {
            return view('adminbook');
        });
        
        Route::get('/admin_collection', function () {
            $collections = Category::withCount('reads as reads')->withCount('books as books')->paginate(5);
            return view('admincollection', [
                'collections' => $collections
            ]);
        });

        Route::middleware(['super'])->group(function () {
            Route::post('/update_user', [UserCRUD::class, 'update']);
            Route::post('/delete_user', [UserCRUD::class, 'delete']);
            
            Route::get('/admin_users', function () {
            
                $users = User::withCount('reads as reads')->paginate(5);
            
                return view('adminusers', [
                    'users' => $users
                ]);
            });
        });
    });
    
});

Route::get('/booksearch', [BookSearch::class, 'search']);

Route::get('/', function () {

    $books = Book::whereRelation('chapters', 'state', 'published')->with('author')->withCount('reads as reads')->orderBy('reads', 'desc')->limit(10)->get();
    
    return view('home', [
        'books' => $books,
    ]);

    return 'hello';
});

Route::get('/collections', function () {

    $collections = Category::withCount('books as books')->paginate(5);
    
    $books->map(function ($book) use($collections) {
        
    });

    return view('collections', [
        'collections' => $collections
    ]);
});

Route::get('/search_collection', [SearchCollection::class , 'search']);

Route::get('/books', function () {

    $books = Book::whereRelation('chapters', 'state', 'published')->with('author')->orderBy('reads', 'desc')->paginate(5);
    $collections = Category::limit(15)->get();

    // dd($books[1]->author()->name);

    return view('books', [
        'books' => $books,
        'collections' => $collections
    ]);

});

Route::get('/books/{category:name}', function(Category $category) {

    $selected_collection = $category->name;
    $books = Book::whereRelation('chapters', 'state', 'published')->whereRelation('category', 'name', $selected_collection)->with('author')->orderBy('reads', 'desc')->paginate(5);
    $collections = Category::limit(15)->get();

    return view('books', [
        'books' => $books,
        'selected_collection' => $selected_collection,
        'collections' => $collections
    ]);
    
});




Route::get('/email/verify', function () {
    return view('verify_email');
})->middleware('auth')->name('verification.notice');

// Route::get('test', function () {
//     return view('verify_email');
// });


 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', function () {
    return view('password_reset');
})->middleware('guest')->name('password.request');
 
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');



 
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');