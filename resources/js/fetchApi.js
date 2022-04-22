export default async function fetchApi(url) {

    let apiurl = `https://api.stackexchange.com/2.3/${url['type']}/${url['id']}?order=desc&sort=activity&site=stackoverflow`;

    const controller = new AbortController;

    let config = {
        signal: controller.signal,
        mode: 'cors',
        method: 'GET',
    };

    try {
        let response = await fetch(apiurl, config)
            .then(origin => { return origin.json(); })
            .then((item) => {
                let origindata = item['items'][0];
                let mydata = {
                    'title': origindata.title,
                    'tags': origindata.tags,
                    'has_bestanswer': origindata.accepted_answer_id === undefined ? false : true
                }
                return mydata;
            }).catch((error) => console.error(error))
        return response;
    } catch (error) {
        console.error(error)
    }
}

