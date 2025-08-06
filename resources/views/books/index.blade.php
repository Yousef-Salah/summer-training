@extends('layouts.books')

@section('page-title', 'Books Information')

@section('content')
    <!-- Create Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('books.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Create New Book
        </a>
    </div>
    
    <table class="table table-striped table-bordered">

        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Number Of Pages</th>
                <th scope="col">Release Date</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->number_of_pages }}</td>
                    <td>{{ $book->release_date }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="text-warning me-2" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-danger" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection
