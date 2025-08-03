@extends('layouts.journal')

@section('content')
<div class="container">
    <h2>Your Journal Entries</h2>

    <a href="{{ route('journals.create') }}" class="btn btn-primary mb-3">+ New Entry</a>

    @foreach ($journals as $journal)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $journal->title }}</h5>
                <p class="card-text text-muted">{{ $journal->created_at->format('F j, Y') }}</p>
                <a href="{{ route('journals.show', $journal) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('journals.edit', $journal) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this entry?')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection