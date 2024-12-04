// require('./bootstrap');
import urlProccessor from './urlProccessor';
import fetchGitInfos from './fetchGitInfos';
import fetchChartsData from './fetchChartsData';
import settingDisplayChange from './settingDisplayChange';
import fetchTags from './fetchTags';


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
        };

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

        }
    })

    $('.img-input .btn-close').on('click', function () {
        if ($('.img-input').length > 1) {
            $(this).closest('.img-input').remove()
        }

    })

    $('.img-del').on('click', function () {
        $(this).closest('.imgs').find('img').attr('src', '')
        $(this).closest('.imgs').find('input').val('')
        $(this).closest('.imgs').find('.file-upload-wrapper, .input-sign').removeClass('d-none')
        $(this).parent().addClass('d-none')
    })

    if ($('.toast').length) {
        $('.toast').each(function () {
            var toast = new bootstrap.Toast(this, {
                delay: 3000 // 設定顯示時間為 5 秒
            });
            toast.show(); // 強制顯示 Toast
        });
    }

    $(".sortable").sortable({
        items: '.imgs:has(input[type="hidden"]:not([value=""]))', // 只允許拖曳 已存過 的 避免後端file覆蓋hidden key
    });
    $(".sortable").disableSelection();

    $('.file-input').on('change', function () {
        const file = this.files[0];
        const fileInput = $(this).closest('.file-upload-wrapper');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // 找到與 file-input 同層的 .file-preview
                // fileInput.parent().find('.file-preview img').attr('src', e.target.result);
                fileInput.closest('.imgs').find('img').attr('src', e.target.result);
                fileInput.closest('.imgs').find('.input-show').removeClass('d-none');

                // 隱藏 .plus-sign
                fileInput.addClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    $('input[name="addTags"]').on('input', function () {

        $(this).autocomplete({
            source: async function (request, response) {

                let data = await fetchTags(request.term);

                response($.map(data, function (item) {
                    // item.elementTags.forEach()
                    return {
                        // name: item.name,
                        value: item.value,
                        label: item.name,
                        // id: item.id,
                        badge: item.badge
                    };
                }));
            },
            select: function (event, ui) {

                var list = $('.tags-container:not(#oriTags)')

                var row = $(`<div class="tag-container">${ui.item.badge}<input type="hidden" name="tags[]" value="${ui.item.value}"></div>`);
                $('.btn-close', row).on('click', function () {
                    $(this).closest('.tag-container').remove()
                })
                list.append(row);
                $(this).val('')
                return false;
            }
        })
    })
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

})

