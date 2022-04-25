@extends('models.main_model')
@section('content')
<main class="d-flex flex-column flex-grow-1 align-items-center @if(!isset($resource)) justify-content-center @endif mb-5">

    <div id="input" class="d-flex flex-column justify-content-center mt-2">
        @if(!isset($resource))
        <span id="main-information" class="align-items-center fs-3 px-2">查詢已有文章或加入新資源</span>
        @endif
        <form method="POST" action="{{url('/resource/search')}}" id="searchForm" class="input-group fs-3 pt-4 mb-3">
            @csrf
            <input type="url" name="resource" id="resource" class="form-control-md form-control rounded-start" placeholder="http://..." />
            <input type="submit" id="search" class="form-control-md btn btn-outline-secondary @if(!isset($resource)) rounded-end @endif " value="查詢" />
            @isset($resource)
            <input type="submit" id="insert" class="form-control-sm btn btn-outline-secondary btn-sm rounded-end" form="insertForm" value="加入資源" />
            @endisset
        </form>

    </div>

    <div id="loading" class="d-none">

        <div class="spinner-border ms-auto spinner-border-sm m-2" role="status" aria-hidden="true"></div>
        <strong>Loading...</strong>

    </div>

    <div id="result" class="d-flex flex-column align-items-center px-5 mt-4 w-100">
        @isset($resource)
        <h3 class="d-flex align-items-start">查詢結果</h3>
        <table id="resources" class="table">
            <thead>
                <tr>
                    <th>加入資源</th>
                    <th>文獻題名</th>
                    <th>來源</th>
                    <th>tags</th>
                </tr>
            </thead>

            <tbody class="align-middle">
                <form action="{{url('/resource/create')}}" method="POST" id="insertForm">
                    <tr class="container">
                        @csrf
                        <td class="col-1 text-center">
                            <input class="form-check-input" type="checkbox" id="targetResource" value="" aria-label="add-resource" />
                        </td>
                        <td class="col-6 fw-bold text-break fst-italic">
                            <input type="hidden" name="title" value="{{$resource->title}}" />
                            <input type="hidden" name="domain" value="https://stackoverflow.com/" />
                            <input type="hidden" name="location" value="{{$resource->location}}" />
                            <input type="hidden" name="content_language" value="{{$resource->content_language}}" />
                            <input type="hidden" name="creation_date" value="{{$resource->creation_date}}" />
                            <input type="hidden" name="last_answer_date" value="{{$resource->last_answer_date}}" />
                            {{$resource->title}}
                            <!-- @if($resource->bestanswer === true)
                            <i id="useful" class="bi bi-check-circle-fill ps-2"></i>
                            @endif -->
                        </td>
                        <td class="col-2 ">

                            https://stackoverflow.com/

                        </td>
                        <td class="col-3">
                            @foreach($resource->tags as $tag)
                            <button type="button" class="d-inline-flex align-items-center btn btn-secondary btn-sm my-1">
                                <input type="hidden" name="tag[]" value="{{$tag}}" />
                                {{$tag}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                                </svg>
                            </button>
                            @endforeach
                        </td>

                    <tr>
                </form>
            </tbody>
        </table>
        @endisset
    </div>
    @if(session('status'))
    <p>
        {{session('status')}}
        {{session('result')}}
    </p>
    @endif
</main>
@endsection