<div class="col">
    <div class="card" style="min-width:20vw;">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">
                <a href="https://github.com/jerryyehself/{{ $work->git_repository_name }}" class="text-decoration-none">
                    {{ $work->project_name }}
                </a>
            </h5>
            <div class="fs-6 text fw-lighter upd_date">
                <div>Release Date: {{ $work->repo_created_at }}</div>
                <div>Last update: {{ $work->repo_updated_at }}</div>
            </div>
            <p class="card-text"></p>
            <div class="languages">

            </div>
            <div class="tags">
                @foreach($work->latestElements as $tag)
                <div class="badge rounded-pill bg-secondary">
                    {{ $tag->element_name }}
                </div>
                @endforeach
            </div>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
    </div>
</div>