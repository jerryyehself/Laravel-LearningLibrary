<div class="modal fade" id="delete" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">
                    是否確定刪除{{$collection['title'][$key]}}?
                </h5>
            </div>
            <form action="{{ route($collection['page'].'.destroy', $content->id)}}" method="POST">
                <div class="modal-body">

                    @csrf
                    @method("DELETE")

                    <div class="row mb-3">
                        @switch($collection['page'])
                        @case('works')
                        <label class="col-3 my-auto text-center fw-bold" for="projectTitleDelete">作品名稱</label>
                        <div class="col me-3" id="projectTitleDelete">
                            {{$content->project_name}}
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-3 my-auto text-center fw-bold" for="projectDescriptionDelete">作品說明</label>
                        <div class="col me-3" id="projectDescriptionDelete">{{$content->project_description}}</div>
                        @break
                        @endswitch
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="{{$content->id}}_drop">確定刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>