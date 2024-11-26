<div class="col">
    <div class="card" style="min-width:20vw;">
        {{-- <img src="..." class="card-img-top" alt="..."> --}}
        <div class="card-body">
            <h5 class="card-title">
                <a href="https://github.com/jerryyehself/{{ $work->project_name }}" class="text-decoration-none">
                    {{ $work->project_name }}
                </a>
            </h5>
            <div class="fs-6 text fw-lighter">
                <div>Release Date: {{ $work->repo_created_at }}</div>
                {{-- <div>Last update: {{ $work->repo_updated_at }}</div> --}}
            </div>
            <div class="tags">
                @foreach ($work->latestElements as $tag)
                    <x-element-tags :tag="$tag->element_name" />
                @endforeach
            </div>
            <p class="card-text fs-6 mb-0 mt-2">
                @if ($work->project_description)
                    {{ $work->project_description }}
                @endif
            </p>
            <div class="languages">

            </div>

            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
    </div>
</div>
