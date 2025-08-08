@extends('layouts.books')

@section('page-title', 'Create New Book')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Add New Book</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        @include('books._form-content')
    </form>
</div>
@endsection
