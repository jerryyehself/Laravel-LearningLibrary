@extends('models.main_model')
@section('content')
<main class="d-flex flex-column flex-grow-1 align-items-center justify-content-center mb-5">
<!-- <main class="d-flex flex-column justify-content-center align-items-center mt-4"> -->
    <button id='testb'>測試用</button>
    <div id="input" class="d-flex flex-column justify-content-center mt-4">
    <!-- <div id="input" class="w-50"> -->

        <span id="main-information" class="align-items-center fs-3 px-2">查詢已有文章或加入新資源</span>

        <form method="get" action="" class="input-group fs-3 pt-4 pb-5 mb-3">
        <!-- <form method="get" action="" class="input-group align-items-center"> -->
            @csrf
            <input type="url" name="resource" id="resource-getter" class="form-control-md form-control rounded-start" placeholder="http://..."/>
            <input type="submit" id="search" class="form-control-md btn btn-outline-secondary rounded-end " value="查詢" />

            <!-- <input type="url" name="resource" id="resource-getter" class="form-control-sm form-control rounded-start" placeholder="http://..." /> -->
            <!-- <input type="submit" id="submit" class="form-control-sm btn btn-outline-secondary btn-sm" value="查詢" /> -->
            
            <input type="submit" id="submit" class="d-none form-control-sm btn btn-outline-secondary btn-sm rounded-end" value="加入資源" disabled />
            <!-- <input type="submit" id="submit" class="form-control-sm btn btn-outline-secondary btn-sm rounded-end" value="加入資源" disabled /> -->
        </form>
    </div>
    <div id="result" class="d-none">
        <div id="loading" class="d-none">
            <div class="spinner-border ms-auto spinner-border-sm m-2" role="status" aria-hidden="true"></div>
            <strong>Loading...</strong>
        </div>
        <table id="resources" class="d-none">
            <thead>
                <tr>
                    <th class="text-nowrap">實用度</th>
                    <th>文獻題名</th>
                    <th>來源</th>
                    <th>tags</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                
            </tbody>
        </table>

    </div>
    <!-- @isset($rows)
        @foreach($rows as $row)
            {{$row}}
        @endforeach
        @endisset -->
    </div>
</main>
<!-- @section('script') -->
<!-- <script type="text/javascript">
    
    

    function tryajax(resource) {

        let aresource = $('#resource-getter').val();

        let resource_domain = aresource.split('/')[2];

        if (resource_domain === "stackoverflow.com") {

            let stackoverflow_method = aresource.split('/')[3];

            if (stackoverflow_method === "questions") {

                let question_id = aresource.split('/')[4];

                $.ajax({
                    beforeSend: function() {
                        $('#loading').attr('class', 'd-block');
                    },
                    url: `https://api.stackexchange.com/2.3/questions/${ question_id }?order=desc&sort=activity&site=stackoverflow`,
                    timeout: 20000,
                    method: "get",
                    dataType: 'json',
                    success: function(data) {
                        let stacktags = data['items'][0]['tags'];

                        stacktags.forEach(function(tag) {

                            $('#tags').append(`<li class="list-group-item btn btn-outline-secondary">${ tag }</li>`);

                        })
                    },
                    error: function() {
                        alert('aa');
                    },
                    complete: function() {
                        $('#loading').attr('class', 'd-none');
                    }
                })
            }
        }
    }
</script> -->
<!-- @endsection -->
@endsection