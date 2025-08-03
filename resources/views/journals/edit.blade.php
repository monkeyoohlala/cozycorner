@extends('layouts.journal')

@section('title', 'Edit Journal')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-lg-8 col-md-10">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
                <h2 class="mb-4 fw-bold text-primary">Edit Journal Entry</h2>

                <form method="POST" action="{{ route('journals.update', $journal->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fs-5">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $journal->title) }}"
                            class="form-control form-control-lg"
                            placeholder="Enter your journal title"
                        >
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Content --}}
                    <div class="mb-4">
                        <label for="content" class="form-label fs-5">Content</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="10"
                            class="form-control"
                            placeholder="Write your thoughts here..."
                        >{{ old('content', $journal->content) }}</textarea>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('journals.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection