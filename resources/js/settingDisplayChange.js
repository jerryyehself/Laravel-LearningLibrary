import fetchApi from './fetchApi';
export default function settingDisplayChange() {
    $('[data-entity="works"]').map(function () {
        $(this).on('change', function () {
            fetch('../api/changeEntityDisplay', {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    entity: $(this).data('entity'),
                    id: $(this).data('id'),
                    display: this.checked,
                }),
                method: "PUT"
            })
        })
    })

}
$(function () {
    settingDisplayChange();
})