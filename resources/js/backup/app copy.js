require('../bootstrap');

$(document).ready(() => {

    let resourceintable = 0;

    $("#search").on("click",
        // $("#testb").on("click",

        () => {

            if (resourceintable < 5) {

                resourceintable++;

                let aresource = $('#resource-getter').val();

                let resource_domain = aresource.split('/')[2];

                if (resource_domain === "stackoverflow.com") {

                    let stackoverflow_method = aresource.split('/')[3];

                    if (stackoverflow_method === "questions") {

                        let question_id = aresource.split('/')[4];
                        //console.log('aa');
                        $.ajax({
                            beforeSend:
                                () => {
                                    $('#input').attr('class', 'd-none');
                                    $('#loading').attr('class', 'd-flex align-items-center');
                                },
                            url: `https://api.stackexchange.com/2.3/questions/${question_id}?order=desc&sort=activity&site=stackoverflow`,
                            timeout: 20000000,
                            method: "get",
                            dataType: 'json',
                            success:
                                (data) => {
                                    let stackitem = data['items'][0];

                                    let stacktags = stackitem['tags'];//.forEach(function(tag, index){
                                    let stacktitle = stackitem['title'];
                                    let stackcreatedate = stackitem['creation_date'];

                                    $('main').attr('class', 'd-flex flex-column justify-content-center align-items-center mt-4');
                                    $('#input').attr('class', 'w-50');
                                    $('#main-information').attr('class', 'd-none');
                                    $('form').attr('class', 'input-group align-items-center');
                                    $('#resource-getter').attr('class', 'form-control-sm form-control rounded-start');
                                    $('#search').attr('class', 'form-control-sm btn btn-outline-secondary btn-sm border-end-0');
                                    $('#submit').attr({ class: 'form-control-sm btn btn-outline-secondary btn-sm rounded-end', disabled: false });
                                    $('#result').attr('class', 'd-flex flex-column align-items-center px-5 mt-4 w-100');

                                    $('tbody').append(`
                                            <tr class="container">
                                                <td class="col-1 text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="add-resource">
                                                </td>
                                                <td class="col-7 fw-bold text-break fst-italic  bestanswerintable-${resourceintable}">${stacktitle}</i></td>
                                                <td class="col-2 ">
                                                    <img class="col mw-100" src='https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg'/></td>
                                                <td class="col-2 tagsinresource-${resourceintable}"></td>
                                            <tr>`
                                    );

                                    stacktags.forEach((tag) => {

                                        $('.tagsinresource-' + resourceintable).append(`<button type="button" class="d-inline-flex align-items-center btn btn-secondary btn-sm my-1">${tag}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                                            </svg>
                                            </button>
                                        `);
                                    })

                                    console.log('s1');

                                    $.ajax({
                                        url: `https://api.stackexchange.com/2.3/questions/${question_id}/answers?order=desc&sort=votes&site=stackoverflow`,
                                        timeout: 200000,
                                        method: 'get',
                                        dataType: 'json',
                                        success: (bestanswer) => {
                                            let answered = bestanswer['items'][0]['is_accepted'];
                                            console.log('bestanswerintable' + resourceintable);

                                            answered === true ? $('.bestanswerintable-' + resourceintable).append('<i id="useful" class="bi bi-check-circle-fill ps-2"></i>') : console.log('無正解');
                                            console.log('s2');
                                        },
                                        error:
                                            (jqXHR, textStatus, errorThrown) => {
                                                alert(jqXHR.responseText);
                                                $('#loading').html('無法連上伺服器!');
                                            }


                                    })
                                },
                            error:
                                (jqXHR, textStatus, errorThrown) => {
                                    alert(jqXHR.responseText);
                                    $('#loading').html('無法連上伺服器!');
                                },
                            complete:
                                () => {
                                    $('#loading').attr('class', 'd-none');
                                    $('#resources').attr('class', 'table w-100');
                                }

                        })
                    }
                } else {
                    alert('資料太多，請先加入現有資源');
                }
            }
        }
    )

})

var zz = {
    'resourcedomain': 'resourcedomain',
    'asd': 'asd',
    'dsa': 'dsa'
};

$.ajax({
    url: "",
    method: "post",
    dataType: "json",
    data: zz,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    success: (data) => {
        console.log(data);
    },
    complete: (data) => {
        console.log(data);
    },
    cache: false,
    async: false,
    error:
        (jqXHR, textStatus, errorThrown) => {
            console.log(textStatus);
            console.log(errorThrown);
            console.log(jqXHR.responseText);
            //$('#loading').html('無法連上伺服器!');
        },
})