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

    $('#week-planning button.more-planning-actions-button').click(function() {
        $(this).closest('.week-date').find('.more-planning-actions').slideToggle()
    })

    $('#week-planning img.toggle-notes').click(function() {
        $(this).closest('.week-date').find('.dish-notes').slideToggle()
    })

    $('form.add-picture-to-planned-dish input[type=file]').change(function() {
        $(this).closest('form').submit()
    })

    $("#dishes-list #search").focus(function() {
        if(this.value == "Search...") {
            this.value = ""
        }
    })

    $("#dishes-list #search").keyup(function() {
        function isTextMatch(text, search) {
            text = text.replace(/[^\w]/g, "").toLowerCase()
            search = search.replace(/[^\w]/g, "").toLowerCase()

            return text.indexOf(search) >= 0
        }

        var searchText = $(this).val()

        if(searchText) {
            $('#dishes-list .dish').hide()

            $('.dish-name').each(function() {
                if(isTextMatch($(this).text(), searchText)) {
                    $(this).closest('div.dish').show()
                }
            })
        }
        else {
            $('#dishes-list .dish').show()
        }

    })

})