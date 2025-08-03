@extends('layouts.journal')

@section('content')
<div class="container">
    <h2>{{ $journal->title }}</h2>
    <p class="text-muted">{{ $journal->created_at->format('F j, Y') }}</p>

    <div class="mb-4">
        {!! nl2br(e($journal->content)) !!}
    </div>

    <a href="{{ route('journals.edit', $journal) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('journals.index') }}" class="btn btn-secondary">Back to List</a>
    
    <form method="POST" action="{{ route('journals.generateAI', $journal->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-3">Tomorrow's Activity Forecast</button>
    </form>
    

    @isset($aiResponse)
        <div class="mt-4 alert alert-info">
            <h5>AI Response:</h5>
            <p>{{ $aiResponse }}</p>
        </div>
    @endisset

</div>
@endsection