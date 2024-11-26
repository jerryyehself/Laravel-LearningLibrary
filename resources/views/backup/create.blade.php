<div class="modal fade" id="insert" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">
                    新增{{ $collection['title'][0] }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url(Request::segment(2) . '.store') }} " method="POST">
                @csrf
                <div class="modal-body d-flex flex-column">

                    @switch(Request::segment(2))
                        @case('works')
                            <div class="row mb-3 ">
                                <label class="col-3 my-auto text-center fw-bold" for="projectTitleInsert">作品名稱</label>
                                <input type="hidden" name="projectTitleInsert" class="col form-control form-control-sm me-3"
                                    id="projectTitleInsert" required>
                            </div>
                            <div class=" row mb-3">
                                <label class="col-3 my-auto text-center fw-bold" for="projectDomainInsert">所屬網域</label>
                                <select name="" class="form-select form-select-sm col me-3" id=""
                                    aria-label="domain selection" id="projectDomainInsert">

                                </select>
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto text-center fw-bold" for="projectUrlInsert">作品連結</label>
                                <input type="text" name="projectUrlInsert" class="col form-control form-control-sm me-3"
                                    id="projectUrlInsert">
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto text-center fw-bold" for="projectGitInsert">Git儲存庫</label>
                                <input type="text" name="projectGitInsert" class="col form-control form-control-sm me-3"
                                    id="projectGitInsert" required>
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 my-auto text-center fw-bold" for="projectMaintenceInsert">維護狀態</label>
                                <div class="col form-check form-switch form-check-inline">
                                    <input class="form-check-input col form-control me-3" type="checkbox" role="switch"
                                        id="projectMaintenceInsert" name="projectMaintenceInsert" />
                                    <label class="form-check-label text-success" for="projectMaintenceInsert"
                                        id="maintencestatus">持續維護中</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-3 my-auto text-center fw-bold" for="projectDescriptionInsert">作品說明</label>
                                <textarea name="projectDescriptionInsert" class="col form-control form-control-sm me-3" id="projectDescriptionInsert"></textarea>
                            </div>
                        @break
                    @endswitch
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </form>
        </div>
    </div>
</div>
