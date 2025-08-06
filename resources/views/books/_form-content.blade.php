<!-- Title -->
<div class="mb-3">
    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $book->title) }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Author Dropdown -->
<div class="mb-3">
    <label for="author_id" class="form-label">Author <span class="text-danger">*</span></label>
    <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror"
        required>
        <option value="">-- Select Author --</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" @selected(old('author_id', $book->author_id) == $author->id)>
                {{ $author->name }}
            </option>
        @endforeach
    </select>
    @error('author_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Number of Pages -->
<div class="mb-3">
    <label for="number_of_pages" class="form-label">Number of Pages</label>
    <input type="number" name="number_of_pages" id="number_of_pages"
        class="form-control @error('number_of_pages') is-invalid @enderror"
        value="{{ old('number_of_pages', $book->number_of_pages) }}">
    @error('number_of_pages')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Release Date -->
<div class="mb-3">
    <label for="release_date" class="form-label">Release Date</label>
    <input type="date" name="release_date" id="release_date"
        class="form-control @error('release_date') is-invalid @enderror"
        value="{{ old('release_date', $book->release_date) }}">
    @error('release_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Buttons -->
<div class="d-flex justify-content-between">
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Cancel
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save-fill"></i> Save Book
    </button>
</div>
