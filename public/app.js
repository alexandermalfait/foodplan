$(function() {
    $('div.preparation-time').raty({
        number: 5,
        path: BASE_URL + "/raty-2.5.2/lib/img",
        click: function(score, event) {
            $(this).find('input[type=hidden]').val(score)
        } ,

        score: function() {
            return $(this).find('input[type=hidden]').val()
        }
    })
})