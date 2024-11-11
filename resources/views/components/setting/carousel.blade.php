<div class="container border rounded h-100">
    <div id="carouselExampleControls"
        class="carousel carousel-dark slide h-100 d-flex align-items-center justify-content-center h-100"
        data-bs-ride="carousel">
        @if ($album)
            <div class="carousel-inner h-100">
                @foreach ($album as $img)
                    <div class="carousel-item active">
                        <img src="" class="d-block w-100" alt="">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @else
            <h6 class="text-muted">
                目前沒有上傳圖片
            </h6>
        @endif
    </div>
</div>
