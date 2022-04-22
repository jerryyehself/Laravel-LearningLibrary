import fetchApi from './fetchApi';
export default function urlProccessor() {

    var url = new URL(document.querySelector('#resource').value);

    if (url.host !== 'stackoverflow.com')
        throw console.error('請輸入stackoverflow網域的文章');

    var path = []

    path['type'] = url.pathname.split('/')[1]
    path['id'] = url.pathname.split('/')[2]

    fetchApi(path).then(bb => console.log(bb))

}