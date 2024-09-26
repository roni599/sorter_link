@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto px-4 py-4 sm:py-4 lg:px-8 sm:px-6 lg:px-8">
        <form action="{{ route('user.form.category') }}" method="GET">
            <div class="mb-3">
                <label for="category" class="form-label">Select Category For Create Form</label>
                <select class="form-select" id="category" name="category_id" required onchange="this.form.submit()">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>    
    </div>
@endsection
