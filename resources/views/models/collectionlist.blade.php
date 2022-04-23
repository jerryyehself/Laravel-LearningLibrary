<h4 class="mx-auto align-middle text-light">資源類型</h4>
<div class="list-group mx-2">
    <a class="list-group-item list-group-item-action" href="/setting/sourcesites">資源網站</a>
    <a class="list-group-item list-group-item-action" href="{{url('/setting/works')}}">作品</a>

    <div class="accordion accordion-flush " id="practiceTypeList">
        <div class="accordion-item ">
            <button type="button" class="list-group-item list-group-item-action accordion-button border-0" data-bs-toggle="collapse" data-bs-target="#practiceType" aria-expanded="false" aria-controls="practiceType">
                實作類型
            </button>
            <div id="practiceType" class="accordion-collapse collapse show">
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

    <a class="list-group-item list-group-item-action" href="documents">官方文件</a>
</div>