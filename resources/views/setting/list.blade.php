<h4 class="mx-auto align-middle text-light">設定項目</h4>
<div class="list-group mx-2">
    <a class="list-group-item list-group-item-action" href="{{url('/setting/sourcesites')}}">資源網域</a>
    <a class="list-group-item list-group-item-action" href="{{url('/setting/works')}}">作品</a>

    <div class="accordion accordion-flush " id="practiceTypeList">
        <div class="accordion-item">
            <button type="button" class="list-group-item-action accordion-button border-0 accordion-button collapsed px-3 py-2" data-bs-toggle="collapse" data-bs-target="#practiceType" aria-expanded="false" aria-current="true" aria-controls="practiceType">
                實作類型
            </button>
            <div id="practiceType" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action accordion-body" href="{{url('/setting/languages')}}">程式語言</a>
                        <a class="list-group-item list-group-item-action accordion-body" href="{{url('/setting/packagetools')}}">工具套件</a>
                        <a class="list-group-item list-group-item-action accordion-body" href="{{url('/setting/environments')}}">環境</a>
                        <a class="list-group-item list-group-item-action accordion-body" href="{{url('/setting/frameworks')}}">框架</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="list-group-item list-group-item-action" href="{{url('/setting/documents')}}">官方文件</a>
</div>