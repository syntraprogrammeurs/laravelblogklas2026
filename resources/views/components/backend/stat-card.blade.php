@props([
    'color' => 'primary',
    'title',
    'link' => '#',
])

<div class="col-xl-3 col-md-6">
    <div class="card h-100">
        <div class="card-body">
            <div class="small text-uppercase mb-2">Overview</div>
            <div class="d-flex align-items-start justify-content-between gap-3">
                <div>
                    <div class="fs-5 fw-semibold">{{ $title }}</div>
                    <div class="text-muted small mt-2">Realtime module</div>
                </div>
                <span class="badge bg-{{ $color }}">Live</span>
            </div>
        </div>

        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-decoration-none stretched-link" href="{{ $link }}">Open module</a>
            <div class="small">
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
