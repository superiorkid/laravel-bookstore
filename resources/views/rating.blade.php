@extends("layouts.app")

@section("content")
    <div>
        <h1 class="text-2xl font-bold">Insert Rating</h1>

        <form action="{{ route('rating') }}" method="POST" class="mt-5">
            @csrf

            <div class="mb-4">
                <label for="author_id">Author:</label>
                <select name="author_id" id="author_id" class="border py-1 px-2">
                    <option value="">Select Author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="book_id">Book:</label>
                <select name="book_id" id="book_id" class="border py-1 px-2">
                    <option value="">Select Book</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="border py-1 px-2">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $('#author_id').on('change', function() {
            const authorId = $(this).val();
            if(authorId) {
                $.ajax({
                    url: '/author/' + authorId + '/books',
                    type: 'GET',
                    success: function(data) {
                        const bookSelect = $('#book_id');
                        bookSelect.empty();
                        bookSelect.append('<option value="">Select Book</option>');
                        data.forEach(function(book) {
                            bookSelect.append('<option value="' + book.id + '">' + book.name + '</option>');
                        });
                    }
                });
            } else {
                $('#book_id').html('<option value="">Select Book</option>');
            }
        });
    </script>
@endsection
