<div class="modal fade" id="detial" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">
                    {{$content->project_name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column">
                <div class="row">
                    <div class="col-3 border-end">
                        <div class="col fw-bold mb-1">創建日期</div>
                        <div class="col">{{$content->created_at}}</div>
                    </div>
                    <div class="col-3 border-end">
                        <div class="col fw-bold mb-1">最近維護日期</div>
                        <div class="col">{{$content->updated_at}}</div>
                    </div>
                    <div class="col-3 border-end">
                        <div class="col fw-bold mb-1">維護狀態</div>
                        @if($content->still_maintain===1)
                        <div class="col text-success">
                            持續維護中
                        </div>
                        @else
                        <div class="col text-black">
                            已停止維護
                        </div>
                        @endif
                    </div>
                    <div class="col-3">
                        <div class="col fw-bold mb-1">維護次數</div>
                        <div class="col">{{$content->maintained}}</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-auto fw-bold">所屬網域</div>
                    <div class="col">
                        @if($content->release_domain_id===null)
                        無
                        @else
                        $content->release_domain_id
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-auto fw-bold">作品說明</div>
                    <div class="col">{{$content->project_description}}</div>
                </div>
            </div>
        </div>
    </div>
</div>