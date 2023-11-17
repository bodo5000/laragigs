<h1>{{ $heading }}</h1>

@forelse ($listings as $listing)
    <h1>
        <a href='/listing/{{ $listing['id'] }}'>{{ $listing['title'] }}</a>
    </h1>

    <p>
        {{ $listing['description'] }}
    </p>

@empty
    <p>
        No Listings Found
    </p>
@endforelse
