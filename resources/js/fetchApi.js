export default async function fetchApi(url) {

    let apiurl = `https://api.stackexchange.com/2.3/${url['type']}/${url['id']}?order=desc&sort=activity&site=stackoverflow`;

    const controller = new AbortController;

    let config = {
        signal: controller.signal,
        mode: 'cors',
        method: 'GET'
    };

    try {
        let response = await fetch(apiurl, config)
            .then(
                origin => {
                    let jsondata = origin.json()

                    return jsondata;
                }).then((data) => {
                    let newdata = data['items'][0];
                    let mydata = {
                        'title': newdata.title,
                        'tags': newdata.tags,
                        'has_bestanswer': newdata.accepted_answer_id === undefined ? false : true
                    }
                    return mydata;
                })


    } catch (error) {
        console.error(error)
    }
}

