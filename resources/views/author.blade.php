@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-2xl font-bold text-center">Top 10 Most Famous Author</h1>

        <table class="w-full border mt-5">
            <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">No</th>
                <th class="border p-2">Author Name</th>
                <th class="border p-2">Voter</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($topAuthors as $author)
                <?php $i++ ?>
                <tr>
                    <td class="border p-2">{{ $i }}</td>
                    <td class="border p-2">{{ $author->name }}</td>
                    <td class="border p-2">{{ $author->total_votes }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
