window.addEventListener('DOMContentLoaded', () => {
    $('#form').submit(function() {
        $(this).attr('action', postUrl);
    });


    /* create new post */
    $('.btn').click(function() {
        $.ajax( {
            url: 'http://localhost/wordpress/wp-json/wp/v2/posts',
            method: 'POST',
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
            },
            data:{
                'title' : 'ブログはじめてみました',
            }
        } ).done( function ( response ) {
            console.log( response );
        } );
    });
});