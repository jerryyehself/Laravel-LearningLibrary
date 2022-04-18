require('./bootstrap');

function UrlSpilter(resource_url) {

    if (resource_url != '') {

        const resource_url_components = resource_url.split('/');
        const resource_domain = resource_url_components[2];
        const resource_location_paramets = resource_url_components.splice(3, resource_url_components.length - 1);

        let resource = {
            'resource_domain': resource_domain,
            'location_paramets': resource_location_paramets
        }

        return resource

    } else { console.log('未輸入東西') }
}

function Stackapi(resource_url, UrlSpilter) {
    const url_properties = UrlSpilter(resource_url)

    let question_title = ""
    let question_tags = []
    let question_create_date = ""
    let answer_accepted = []
    let answer_accepted_try

    if (url_properties['location_paramets'][0] === 'questions') {
        console.log('aa')

        let question_id = url_properties['location_paramets'][1];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            timeout: 30 * 1000
        });

        $.getJSON(`https://api.stackexchange.com/2.3/questions/${question_id}?order=desc&sort=activity&site=stackoverflow`,

            (stackitem) => {
                $.each(stackitem['items'], (key, infos) => {
                    question_title = infos.title
                    question_create_date = infos.creation_date
                    question_tags.push(infos.tags)
                    answer_accepted = infos.accepted_answer_id === undefined ? false : true
                })
                console.log(answer_accepted_try === undefined)
            }
        );

        let question_part_property = {
            'title': question_title,
            'tags': question_tags,
            'create_date': question_create_date,
            'has_bestanswer': answer_accepted
        }
        console.log('question_part_property')
        return question_part_property
    }
}

function Question_Properties_Getter(resource_url, UrlSpilter, Stackapi) {

    const resource_url_info = UrlSpilter(resource_url)
    const resource_property_info = Stackapi(resource_url, UrlSpilter)

    console.log([resource_url_info, resource_property_info])
    question_json_data = {
        'domain': resource_url_info['resource_domain'],
        'location': resource_url_info['location_paramets'].join('/'),
        'title': resource_property_info['title'],
        'tags': resource_property_info['tags'],
        'create_date': resource_property_info['create_date'],
        'has_bestanswer': resource_property_info['has_bestanswer']
    }

    $.ajax({
        url: "",
        method: "post",
        dataType: "json",
        data: question_json_data,
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

    //return question_json_data
}