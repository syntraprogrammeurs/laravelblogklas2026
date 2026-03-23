@props([
    'keys' => ['success', 'error', 'warning', 'info'],
])

@php
    $typeMap = [
        'success' => 'success',
        'error'   => 'danger',
        'warning' => 'warning',
        'info'    => 'info',
    ];
@endphp

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

@foreach ($keys as $key)
    @if (session()->has($key))
        @php
            $bootstrapType = $typeMap[$key] ?? 'secondary';
            $value = session()->get($key);
            $messages = is_array($value) ? $value : [$value];
            session()->forget($key);
        @endphp

        <div class="alert alert-{{ $bootstrapType }} alert-dismissible fade show mb-4" role="alert">
            @if (count($messages) === 1)
                {{ $messages[0] }}
            @else
                <ul class="mb-0 ps-3">
                    @foreach ($messages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif

            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach
