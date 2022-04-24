@extends('models.main_model')
@section('content')
<main class="d-flex flex-grow-1">
    <div class="d-flex align-items-start flex-grow-1">
        <div class="nav d-inline-flex flex-column h-100 me-3 bg-dark" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link px-5" aria-current="page" href="#">Active</a>
            <a class="nav-link px-5" href="#">Link</a>
            <a class="nav-link px-5" href="#">Link</a>
        </div>
        <div class="tab-content bg-white flex-grow-1" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
        </div>
    </div>
</main>
@endsection