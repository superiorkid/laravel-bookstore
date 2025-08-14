<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function home(Request $request)
    {
        $perPage = $request->input('item-shown', 10);
        $search = $request->input('search');

        $books = Book::query()
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhereHas('author', function($q) use ($search) {
                       $q->where('name', 'like', '%'.$search.'%');
                    });
            })
            ->with(['author', 'ratings', "category"])
            ->paginate($perPage);

        return view('home', compact('books'));
    }

    public function topAuthors() {
        $topAuthors = DB::table('authors')
            ->joinSub(
                DB::table('ratings')
                    ->join('books', 'books.id', '=', 'ratings.book_id')
                    ->where('ratings.rating', '>', 5)
                    ->select('books.author_id', DB::raw('COUNT(*) as votes'))
                    ->groupBy('books.author_id'),
                'author_votes',
                'authors.id',
                '=',
                'author_votes.author_id'
            )
            ->select('authors.name', 'author_votes.votes as total_votes')
            ->orderByDesc('total_votes')
            ->take(10)
            ->get();

        return view('author', compact('topAuthors'));
    }

    public function ratingForm(){
        $authors = Author::query()->get();
        return view('rating', compact('authors'));
    }

    public function getBooksByAuthor($authorId)
    {
        $books = Book::query()->where('author_id', $authorId)->get();
        return response()->json($books);
    }

    public function addRatings(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating'  => 'required|integer|min:1|max:10',
        ]);

        Rating::query()->create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('home');
    }
}
