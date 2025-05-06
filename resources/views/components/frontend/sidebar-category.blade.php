<div class="widget ">
    <div class="widget-title">
        <h5>Categories</h5>
    </div>
    @if ($categories->count() > 0)
    <div class="widget-categories">
        @foreach ($categories as $category)
        <a class="category-item" href="{{ route("frontend.category", $category->slug) }}">
            <p>{{ $category->title }}</p>
        </a>
        @endforeach
    </div>
    @else
    <div>No category found!</div>
    @endif
</div>
