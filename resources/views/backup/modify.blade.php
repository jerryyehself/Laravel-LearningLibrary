<div class="modal fade" id="modify" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                @dd(csrf_token())
                @switch(Request::segment(2))
                    @case('works')
                        <h5 class="modal-title fw-bold" id="projectModify">
                            修改作品介紹與設定
                        </h5>
                    </div>
                    <form action="{{ route(Request::segment(2) . '.update', $content->id) }} " method="POST">
                        <div class="modal-body">
                            @csrf

                            @method('PATCH')
                            <div class="row mb-3 ">
                                <label class="col-3 my-auto fw-bold" for="project_name">作品名稱</label>
                                <div class="col p-0">{{ $content->project_name }}</div>
                            </div>
                            <div class="row mb-3 ">
                                <label class="col-3 my-auto fw-bold" for="project_name_cn">作品中文名稱</label>
                                <input type="text" name="project_name_cn" class="col form-control form-control-sm me-3"
                                    value="{{ $content->project_name_cn }}">
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto fw-bold" for="projectDomainModify">所屬網域</label>
                                <select name="" class="form-select form-select-sm col me-3" id=""
                                    aria-label="domain selection" id="projectDomainModify">
                                    <option value="">無</option>
                                    {{-- @foreach ($collection['content']['domainlist'] as $domain)
                            <option value="{{$domain->id}}">{{$domain->domain_name}}</option>
                            @endforeach --}}
                                </select>
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto fw-bold" for="release_url">作品連結</label>
                                <input type="text" name="release_url" class="col form-control form-control-sm me-3"
                                    id="release_url" value="{{ $content->release_url }}">
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto fw-bold" for="git_repository_name">Git儲存庫</label>
                                <span class="col p-0">{{ $content->git_repository_name }}</span>
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto fw-bold" for="still_maintain">維護狀態</label>
                                <div class="col form-check form-switch form-check-inline">
                                    <input class="form-check-input col form-control me-3" type="checkbox" role="switch"
                                        id="still_maintain" name="still_maintain"
                                        @if ($content->still_maintain === 1) checked @endif>

                                    <label class="form-check-label text-success" for="still_maintain"
                                        id="maintencestatus">持續維護中</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-3 my-auto fw-bold" for="project_description">作品說明</label>
                                <textarea name="project_description" class="col form-control form-control-sm me-3" id="project_description">
                                    {{ $content->project_description }}
                                </textarea>
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
