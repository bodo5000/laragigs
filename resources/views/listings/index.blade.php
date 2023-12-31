<x-layout.layout>
    @include('components.layout.partials._hero')
    @include('components.layout.partials._serch')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @forelse ($listings as $listing)
            <x-listing-card :listing="$listing" />
        @empty
            <p>
                No Jobs Found
            </p>
        @endforelse
    </div>

    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
</x-layout.layout>
