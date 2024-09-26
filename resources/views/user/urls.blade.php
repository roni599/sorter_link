@extends('layouts.app')

@section('content')
<div class="container max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
    <h1>Your Shortened URLs</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

  <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.urls.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="original_url" class="form-label">Enter your URL</label>
            <input type="url" name="original_url" class="form-control" placeholder="https://example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">Shorten</button>
    </form>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Click Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($urls as $url)
                <tr>
                    <td>{{ $url->original_url }}</td>
                    <td><a href="{{ route('urls.redirect', $url->short_url) }}" target="_blank">{{ url($url->short_url) }}</a></td>
                    <td>{{ $url->click_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
