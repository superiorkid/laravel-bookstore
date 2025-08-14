@extends("layouts.app")

@section("content")
    <div>
        <form action="{{ route('home') }}" method="GET" class="space-y-2">
            <div class="flex gap-6">
                <label for="item-shown">List shown:</label>
                <select name="item-shown" id="item-shown" class="border py-1 px-2">
                    @foreach (range(10, 100, 10) as $value)
                        <option value="{{ $value }}" {{ request('item-shown', 10) == $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-6 items-center">
                <label for="search">Search:</label>
                <input id="search" name="search" type="search"
                       placeholder="search..." class="border py-1 px-2"
                       value="{{ request('search') }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            @if(request()->has('search') || request()->has('item-shown'))
                <a href="{{ route('home') }}" class="text-red-500 ml-4">Reset filters</a>
            @endif
        </form>
    </div>

    <div class="mt-8">
        @if($books->count())
            <table class="w-full border">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Book Name</th>
                    <th class="border p-2">Category Name</th>
                    <th class="border p-2">Author Name</th>
                    <th class="border p-2">Average Rating</th>
                    <th class="border p-2">Voter</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0 ?>
                @foreach($books as $book)
                    <?php $i++ ?>
                    <tr>
                        <td class="border p-2">{{ $i }}</td>
                        <td class="border p-2">{{ $book->name }}</td>
                        <td class="border p-2">{{ $book->category->name }}</td>
                        <td class="border p-2">{{ $book->author->name }}</td>
                        <td class="border p-2">{{ number_format($book->average_rating, 2) }}</td>
                        <td class="border p-2">{{ count($book->ratings) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $books->appends(request()->query())->links() }}
            </div>
        @else
            <p class="mt-4 text-gray-500">No books found matching your criteria.</p>
        @endif
    </div>
@endsection
