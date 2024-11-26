<div class="toast position-absolute start-50 translate-middle align-items-center text-white border-0 m-3" role="alert"
    aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true">
    <div class="d-flex @if ($message['status'] !== 'faild') bg-success text-success @endif bg-opacity-25 rounded-2">
        <div class="toast-body">
            {{ $message['main'] }}
            @if ($message['status'] === 'deleted')
                <button type="button" class="btn btn-primary btn-sm">復原刪除</button>
            @endif
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
