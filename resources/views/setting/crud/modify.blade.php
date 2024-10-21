<div class="modal fade" id="modify" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                @switch(Request::segment(2))
                @case('works')
                <h5 class="modal-title fw-bold" id="projectModify">
                    修改作品介紹與設定
                </h5>
            </div>
            <form action="{{ route(Request::segment(2).'.update', $content->id) }} " method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3 ">
                        <label class="col-3 my-auto text-center fw-bold" for="projectTitleModify">作品名稱</label>
                        <input type="text" name="projectTitleModify" class="col form-control form-control-sm me-3" id="projectTitleModify" value="{{$content->project_name}}">
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 my-auto text-center fw-bold" for="projectDomainModify">所屬網域</label>
                        <select name="" class="form-select form-select-sm col me-3" id="" aria-label="domain selection" id="projectDomainModify">
                            <option value="">無</option>
                            @foreach($collection['content']['domainlist'] as $domain)
                            <option value="{{$domain->id}}">{{$domain->domain_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 my-auto text-center fw-bold" for="projectUrlModify">作品連結</label>
                        <input type="text" name="projectUrlModify" class="col form-control form-control-sm me-3" id="projectUrlModify" value="{{$content->release_url}}">
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 my-auto text-center fw-bold" for="projectGitModify">Git儲存庫</label>
                        <input type="text" name="projectGitModify" class="col form-control form-control-sm me-3" id="projectGitModify" value="{{$content->git_repository_url}}">
                    </div>
                    <div class="row mb-3">
                        <label class="col-3 my-auto text-center fw-bold" for="projectMaintenceModify">維護狀態</label>
                        <div class="col form-check form-switch form-check-inline">
                            <input class="form-check-input col form-control me-3" type="checkbox" role="switch" id="projectMaintenceModify" name="projectMaintenceModify" @if($content->still_maintain===1) checked @endif>

                            <label class="form-check-label text-success" for="projectMaintenceModify" id="maintencestatus">持續維護中</label>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-3 my-auto text-center fw-bold" for="projectDescriptionModify">作品說明</label>
                        <textarea name="projectDescriptionModify" class="col form-control form-control-sm me-3" id="projectDescriptionModify">{{$content->project_description}}</textarea>
                    </div>
                    @break
                    @endswitch
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">放棄修改</button>
                    <button type="submit" class="btn btn-primary">儲存修改內容</button>
                </div>
            </form>
        </div>
    </div>
</div>