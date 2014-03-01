$(function() {
    $('.focus').focus()

    $('div.preparation-time div.stars').raty({
        number: 5,
        path: BASE_URL + "/raty-2.5.2/lib/img",

        click: function(score, event) {
            $(this).closest('div.preparation-time').find('input').val(score)
        } ,

        score: function() {
            return $(this).closest('div.preparation-time').find('input').val()
        }
    })

    $('div.preparation-time input').change(function() {
        if($(this).val() > 5) {
            $(this).val(5)
        }

        $(this).closest('div.preparation-time').find('div.stars').raty("setScore", $(this).val())
    })

    $('div.preparation-time-view').raty({
        number: 5,
        path: BASE_URL + "/raty-2.5.2/lib/img",
        readOnly: true,

        score: function() {
            return $(this).data('value')
        }
    })
})