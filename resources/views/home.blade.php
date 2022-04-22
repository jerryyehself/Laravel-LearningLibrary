@extends('models.main_model')
@section('content')
<main class="d-flex flex-column flex-grow-1 align-items-center justify-content-center mb-5 position-relative">

    <div id="input" class="d-flex flex-column justify-content-center mt-4">
        @if(!isset($resource))
        <span id="main-information" class="align-items-center fs-3 px-2">查詢已有文章或加入新資源</span>
        @endif
        <form method="POST" action="" class="input-group fs-3 pt-4 pb-5 mb-3">
            @csrf
            <input type="url" name="resource" id="resource" class="form-control-md form-control rounded-start" placeholder="http://..." />
            <button type="button" id="search" class="form-control-md btn btn-outline-secondary rounded-end ">查詢</button>
            @isset($resource)
            <button type="button" id="insert" class="form-control-sm btn btn-outline-secondary btn-sm rounded-end" disabled>加入資源</button>
            @endisset
        </form>

    </div>

    <div id="loading" class="d-none">

        <div class="spinner-border ms-auto spinner-border-sm m-2" role="status" aria-hidden="true"></div>
        <strong>Loading...</strong>

    </div>

    <div id="result" class="d-flex flex-column align-items-center px-5 mt-4 w-100">
        @isset($resource)

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
                <tr class="container">

                    <td class="col-1 text-center">
                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="add-resource" />
                    </td>
                    <td class="col-6 fw-bold text-break fst-italic">
                        {{$resource->resourcetitle}}
                        @if($resource->bestanswer === true)
                        <i id="useful" class="bi bi-check-circle-fill ps-2"></i>
                        @endif
                    </td>
                    <td class="col-2 ">

                        <!-- <img class="col mw-100" src='' /> -->

                    </td>
                    <td class="col-3">
                        @foreach($resource->tags as $tag)
                        <button type="button" class="d-inline-flex align-items-center btn btn-secondary btn-sm my-1">
                            {{$tag}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                            </svg>
                        </button>
                        @endforeach
                    </td>

                <tr>
            </tbody>
        </table>
        @endisset
    </div>
</main>
@endsection