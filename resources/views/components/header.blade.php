<div class="container">
    <header class="border-bottom lh-1 py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4">
                <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ route('index') }}">News</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Log in</a>
            </div>
        </div>
    </header>
    @include('components.menu')
</div>
