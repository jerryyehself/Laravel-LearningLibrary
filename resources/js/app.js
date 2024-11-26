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
                list.append($(ui.item.row));
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $(item.autoCompleteItem).appendTo(ul);
        };;

    })

    $('[name="cancelBtn"]').on('click', function () {

    })

    $('.btn-close', '.tags-container').on('click', function () {
        $(this).closest('.tag-container').remove()
    })

    $('[name="submitBtn"]').on('click', function () {
        if (confirm('確認送出嗎')) $('#main').submit()
    })

    $('[data-tag-fn="reset"]').on('click', function () {
        var tagsContainer = $('.tags-container:not("#oriTags")').empty()
        $('.tag-container', '#oriTags').each(function (key, item) {
            var cloneTag = $(item).clone(true)
            cloneTag.attr('disabled', false)
            tagsContainer.append(cloneTag)
        })
    })

    $('.img-input input').on('input', function () {
        if (this.files && this.files.length > 0) {
            $(this).attr('data-has-file', 'true');
            if ($('.img-input, .imgs').length < 5 && $('.img-input input[data-has-file=false]').length < 1) {
                console.log($('.img-input, .img').length < 5 && $('.img-input input[data-has-file=false]').length < 1)
                var clone = $(this).parent().clone(true)
                $('input', clone).val('')
                $('input', clone).attr('data-has-file', 'false')
                $('.img-input-container').append(clone)
            } else {
                $(this).attr('data-has-file', 'true');
            }

            imgCounterUpdate()
        }
    })

    $('.img-input .btn-close').on('click', function () {
        if ($('.img-input').length > 1) {
            $(this).closest('.img-input').remove()
            imgCounterUpdate()
        }

    })

    $('.img-del').on('click', function () {
        $(this).closest('.imgs').remove()
    })

    if ($('.toast').length) {
        $('.toast').each(function () {
            var toast = new bootstrap.Toast(this, {
                delay: 3000 // 設定顯示時間為 5 秒
            });
            toast.show(); // 強制顯示 Toast
        });
    }

    $(".sortable").sortable();
    $(".sortable").disableSelection();

    // $('[data-tag-fn="add"]').on('click',function(){
    //     $('')
    // })

    // console.log(event.target)
    // fetchChartsData('type')


    // typeInput.addEventListener('input', async function () {
    //     let works = await fetchGitInfos(this.value);

    //     works.forEach(element => {
    //         console.log(element)
    //     });
    // })
    function imgCounterUpdate() {
        $('.img-counter').text($('.img-input input[data-has-file=true], .imgs').length)
    }

})

