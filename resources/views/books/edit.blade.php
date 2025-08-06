@extends('layouts.books')

@section('page-title', 'Create New Book')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Edit Book</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('books._form-content')
    </form>
</div>
@endsection
