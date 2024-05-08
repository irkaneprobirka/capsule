$(() => {

    $('#catalog-pjax').on('click', '.like', function(e) {
        $.ajax({
            url: '/account/look/add-like?id=' + $(this).data('id'),
            method: 'post',
            success: (data) => {
                if(data) {
                    $(this).find('.count-like').html(data)
                }
            }
        })
    })

    $('#catalog-pjax').on('click', '.dislike', function(e) {
        $.ajax({
            url: '/account/look/add-dislike',
            method: 'post',
            dataType: 'json',
            data: {id:  $(this).data('id')},
            success: (data) => {
                if(data == 1) {
                    $.pjax.reload({container: '#catalog-pjax'})
                }
            }
        })
    })

    $('#catalog-pjax, #catalog-view-pjax').on('click', '.btn-add-cart', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            // method: 'get',
            dataType: 'json',
            // data: {id:  $(this).data('id')},
            success: (data) => {
            }
        })
    })

    $('#cart-pjax').on('click', '.btn-add-cart', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            // method: 'post',
            dataType: 'json',
            // data: {id: $(this).data('id')},
            success: (data) => {
                if (data == 1) {
                    $.pjax.reload({container: '#cart-pjax'})
                }
            }
        })
    })

    $('.btn-cart-clear').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            // method: 'post',
            dataType: 'json',
            // data: {id: $(this).data('id')},
            success: (data) => {
                if (data == 1) {
                    $.pjax.reload({container: '#cart-pjax'});

                }
            }
        })
    })


})

