@extends('layouts.journal')

@section('content')
<div class="container">
    <h2>New Journal Entry</h2>

    <form action="{{ route('journals.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" rows="8" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Entry</button>
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection