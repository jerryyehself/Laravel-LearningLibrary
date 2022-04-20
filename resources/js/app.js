require('./bootstrap');
import urlProccessor from './urlProccessor';

$(document).ready(() => {
    const search = document.querySelector('#search')
    search.addEventListener('click', () => {



        urlProccessor();
    })
})


