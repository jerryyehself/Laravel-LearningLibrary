@extends('models.main_model')
@section('content')
<main class="d-flex flex-column container h-100 my-4">
    <h3 class="d-flex justify-content-center">新增網域</h3>
    @include('models.proccessor')
    <div id="settingCarousel" class="carousel slide flex-grow-1" data-bs-interval="false">
        <div class="carousel-inner mx-auto my-2">
            <div class="carousel-item active">
                <div class="d-flex flex-column w-50 mx-auto bg-light rounded-3 p-3" name="domains">
                    <form class="d-flex flex-column" id="inputer" action="setting/domain" method="post">
                        @csrf
                        @foreach($formcontents as $formcontent)
                        <div class="pt-2">
                            <label for="{{$formcontent->label}}" class="d-flex form-label">
                                {{$formcontent->label}}
                                @if($formcontent->label=='API')
                                <div class="form-check form-switch form-check-inline ms-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-bs-toggle="collapse" data-bs-target="#domainApi_container" aria-expanded="false" aria-controls="domainApi_container">
                                </div>
                                @endif
                            </label>
                            <div class="@if($formcontent->label=='API') collapse @endif" id="{{$formcontent->id}}_container">
                                <input type="{{$formcontent->type}}" name="{{$formcontent->id}}" id="{{$formcontent->id}}" class="form-control" @if($formcontent->label !='API') required @else disabled @endif />
                            </div>
                        </div>
                        @endforeach
                        <div class="d-flex pt-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" id="valid_btn" data-bs-target="#settingCarousel" data-bs-slide="next">驗證資料</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="carousel-item my-auto h-100">
                <div class="d-flex flex-column w-50 mx-auto mt-2">
                    <h3>驗證結果</h3>
                    <div class="d-flex flex-grow-1 justify-content-center align-items-center visually-hidden" id="valid-loading">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column rounded border bg-light visually-hidden" id="valid-result">

                        <dl class="px-3 py-1 my-2">
                            @foreach($formcontents as $formcontent)
                            <div id="{{$formcontent->id}}_result_container">
                                <dt class="px-1 text-muted" style="margin-bottom: .5rem;">{{$formcontent->label}}</dt>
                                <dl>
                                    @foreach($formcontent->valid as $key => $validlist)
                                    <dd class="px-1" style="margin: 0px;" id="{{$formcontent->id}}_{{$key}}_valid">

                                        {{$validlist}}

                                    </dd>
                                    @endforeach
                                    @if($formcontent->label=='Logo')
                                    <dd class="px-1" id="domainApi_logo">
                                        <img src="" alt="測試圖片" class="img-thumbnail" id="logo" />
                                    </dd>
                                    @endif
                                </dl>
                            </div>
                            @endforeach
                        </dl>
                        <button type="submit" class="form-control" form="inputer">送出</button>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100 my-auto">
                <div class="bg-success w-25 h-25 d-flex flex-column w-50 mx-auto">ccc</div>
            </div>
        </div>

    </div>

</main>
<script type="text/javascript">
    async function DomainFetch(url, feedbackElement) {
        const controller = new AbortController;
        setTimeout(() => {
            controller.abort();
        }, 5000);
        let config = {
            signal: controller.signal
        };
        try {

            let response = await fetch(url, config);

            if (response.status <= 200) {
                await feedbackElement.classList.add('text-success')
                return response.status
            } else if (response.status >= 400) {

                await feedbackElement.classList.add('text-danger')
                throw response.statusText;
            }
        } catch (error) {
            throw error;
        }
    }

    async function CollectionFetch(url, feedbackElement) {

        let config = {
            signal: controller.signal
        };
        try {

            let response = await fetch(url, config);
            if (response.status <= 200) {
                await feedbackElement.classList.add('text-success')
                return response
            } else if (response.status >= 400) {

                await feedbackElement.classList.add('text-danger')
                throw response;
            }
        } catch (error) {
            console.error(error.status);
        }
    }

    const originResultTree = document.querySelector('#valid-result').querySelector(':scope > dl')
    const apiSwitcher = document.querySelector('#flexSwitchCheckDefault')

    apiSwitcher.addEventListener('click', () => {
        if (apiSwitcher.ariaExpanded === 'false') {

            document.querySelector('#domainApi').removeAttribute('required')
            document.querySelector('#domainApi').setAttribute('disabled', "")

        } else {
            document.querySelector('#domainApi').removeAttribute('disabled')
            document.querySelector('#domainApi').setAttribute('required', '')
        }
    })

    var checkElementList = document.querySelector('form')
    let resultOriginClass = [].slice.call(document.querySelectorAll("dd")).map(element => element.className)
    let resultClassId = [].slice.call(document.querySelectorAll("dd")).map(element => element.id)

    const elementClassDictionary = {}
    resultClassId.forEach((key, i) => elementClassDictionary[key] = resultOriginClass[i])

    document.querySelector('#valid_btn').addEventListener('click', (e) => {

        checkElementList.reportValidity()

        if (checkElementList.checkValidity() === true) {
            for (element in elementClassDictionary) {
                var valueKeeper = [].slice.call(document.querySelectorAll('input[type=text],input[type=url]')).map(ele => ele.value)
            }

            document.querySelector('#valid_btn').setAttribute('disabled', 'click')
            document.querySelector('#valid-loading').classList.remove('visually-hidden');
            document.querySelector("#valid-result").classList.add("visually-hidden");
            document.querySelector('#valid-result').replaceChild(document.querySelector('#valid-result').querySelector(':scope > dl'), originResultTree)

            document.querySelector('#domainApi').getAttribute('disabled') === '' ? document.querySelector('#domainApi_result_container').classList.add("visually-hidden") : document.querySelector('#domainApi_result_container').classList.remove("visually-hidden")

            setTimeout(() => {
                document.querySelector('#valid-loading').classList.add('visually-hidden');
                document.querySelector('#valid_btn').removeAttribute('disabled')

                let inputList = [].slice.call(document.querySelectorAll("input[type=text],input[type=url]")).map(ele => ele.value);

                (async function() {
                    let resultContainer = [].slice.call(document.querySelector('#valid-result').querySelectorAll(':scope > dl > div')).map(ele => ele)
                    for await ([keya, value] of Object.entries(valueKeeper)) {
                        let dlContainer = [].slice.call(resultContainer[keya].querySelectorAll("dd")).map(ele => ele.id)

                        for ([keyb, dl] of Object.entries(dlContainer)) {

                            DomainFetch(value, document.querySelector('#' + dl))
                                .catch((err) => console.log(err))
                        }
                        document.querySelector('img').addEventListener('error', () => {
                            document.querySelector('img').classList.add('text-danger')

                            throw ('網址有問題')
                        })

                        keya === '2' ? document.querySelector('img').setAttribute('src', value) : ''
                    }
                })().then(document.querySelector("#valid-result").classList.remove("visually-hidden"))

            }, 5000)
        } else {
            alert('error');
            document.querySelector('valid_btn')
        }
    })
</script>
@endsection