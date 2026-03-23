@props(['title'])

<div class="backend-page-stack">
    <div class="backend-page-header">
        <div>
            <p class="backend-page-meta mb-2">Admin workspace</p>
            <h1 class="backend-page-title">{{ $title }}</h1>
        </div>

        <div class="backend-page-meta">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <div class="backend-page-content">
        {{ $slot }}
    </div>
</div>
