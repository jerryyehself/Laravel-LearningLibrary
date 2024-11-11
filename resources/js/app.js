// require('./bootstrap');
import urlProccessor from './urlProccessor';
import fetchGitInfos from './fetchGitInfos';
import fetchChartsData from './fetchChartsData';
import settingDisplayChange from './settingDisplayChange';


$(document).ready(function () {

    const search = document.querySelector('#search')
    const typeInput = document.querySelector('#resource')
    const date = new Date()

    $('#resource').on('input', function () {

        $(this).autocomplete({
            source: async function (request, response) {

                let data = await fetchGitInfos(request.term)

                response($.map(data, function (item) {
                    // item.elementTags.forEach()
                    return {
                        name: item.project_name,
                        // label: item.searchLabel + item.elementTags.map(function (tag, i) {
                        //     return tag
                        // }),
                        url: item.searchLink,
                        autoCompleteItem: item.autoCompleteItem,
                        id: item.id,
                        row: item.row
                    };
                }));
            },
            _renderItem: function (ul, item) {
                console.log('aa')
                const li = $('<li>')
                    .addClass('list-group-item')
                    .append(`<strong>${item.label}</strong>`);

                // 在這裡添加 badges
                item.badges.forEach(function (tag) {
                    li.append(`<span class="badge bg-primary">${tag}</span> `); // 使用 HTML 來顯示 badge
                });

                return li.appendTo(ul);
            },
            select: function (event, ui) {

                var list = $('#search_history_list tbody')

                var row = $(ui.item.row);
                $('', row)
                list.append($(ui.item.row));
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $(item.autoCompleteItem).appendTo(ul);
        };;

    })

    $('[name="cancelBtn"]').on('click', function () {

    })

    $('[name="submitBtn"]').on('click', function () {
        if (confirm('確認送出嗎')) $('#main').submit()
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


