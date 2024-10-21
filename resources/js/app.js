// require('./bootstrap');
import urlProccessor from './urlProccessor';
import fetchGitInfos from './fetchGitInfos';
import fetchChartsData from './fetchChartsData';


$(document).ready(function () {

    const search = document.querySelector('#search')
    const typeInput = document.querySelector('#resource')
    const date = new Date()
    // console.log(searchHistoryItem)
    // search.addEventListener('click', () => {
    //     urlProccessor();
    // })

    $('#resource').on('input', function () {

        $(this).autocomplete({
            source: async function (request, response) {

                let data = await fetchGitInfos(request.term)

                response($.map(data, function (item) {
                    return {
                        name: item.project_name,
                        label: item.searchLabel,
                        url: item.searchLink,
                        elementTags: item.elementTags,
                        id: item.id
                    };
                }));
            },
            select: function (event, ui) {
                // window.open(ui.item.url)
                let searchHistoryItem = $('.history-item-sample').clone(true)

                // if (!$('#' + ui.item.id).length) {

                searchHistoryItem.attr('id', ui.item.id)
                $('.work-name a', searchHistoryItem).attr('href', ui.item.url)
                $('.work-name a', searchHistoryItem).text(ui.item.name)
                $('.work-elements', searchHistoryItem).text(ui.item.elementTags)
                $('.history-item-time', searchHistoryItem).text(date.toLocaleString())
                // }

                searchHistoryItem.removeClass(['d-none', 'history-item-sample'])

                $('#search_history_list tbody').append(searchHistoryItem);
            }
        });

    })

    // console.log(event.target)
    // fetchChartsData('type')


    // typeInput.addEventListener('input', async function () {
    //     let works = await fetchGitInfos(this.value);

    //     works.forEach(element => {
    //         console.log(element)
    //     });
    // })
})


