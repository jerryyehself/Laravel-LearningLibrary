<div class="toast position-absolute bottom-0 end-0 align-items-center text-white border-0 m-3 show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex @if($message['status']!=='faild') bg-success text-success @endif bg-opacity-25 rounded-2">
        <div class="toast-body">
            {{$message['main']}}
            @if($message['status']==="deleted")
            <button type="button" class="btn btn-primary btn-sm">復原刪除</button>
            @endif
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>