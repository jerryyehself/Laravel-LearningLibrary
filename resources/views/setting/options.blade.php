<button type="button" class="btn btn-outline-primary btn-sm" id="modify-button" data-bs-toggle="modal" data-bs-target="#modify" data-id="{{$content->id}}">
    編輯
</button>
@include('setting.modify')
<button type="button" class="btn btn-outline-danger btn-sm" id="delete-button" data-bs-toggle="modal" data-bs-target="#delete" data-id="{{$content->id}}">
    刪除</button>
@include('setting.delete')