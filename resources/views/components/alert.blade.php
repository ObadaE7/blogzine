@if (session($status))
    <div class="alert alert-{{ $color }} alert-dismissible fade show" role="alert">
        <i class="bi bi-{{ $status === 'success' ? 'check' : 'x' }}-circle me-2"></i>{{ session($status) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
