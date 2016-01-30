//Created by EvansUX
$("form#article-link").submit(function() {
    var data = {
        'filename': $('input[name=filename]').val(),
    };

    $.ajax({
        type: "POST",
        url: "/php/scrape.php",
        data: data
    })
});

