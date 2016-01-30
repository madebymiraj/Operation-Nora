//Created by EvansUX
$("form#article-link").submit(function() {
    var data = {
<<<<<<< HEAD
        'filename': $('input[name=filename]').val(),
    };

    $.ajax({
        type: "POST",
        url: "/php/scrape.php",
        data: data
    })
});

=======
    'url'          : $('input[name=filename]').val(),
    };    
    
    var ajaxRequest = $.ajax({
      type: "POST",
      url: "http://web.njit.edu/~map68/nora/php/scrape.php",
      data: data
    });


ajaxRequest.done(function(data1){
    console.log(data1);
});
ajaxRequest.fail(function(jqXHR, textStatus){
    if (jqXHR.status === 0)
    {
        console.log('Not connect.n Verify Network.');
    }
    else if (jqXHR.status == 404)
    {
        console.log('Requested page not found. [404]');
    }
    else if (jqXHR.status == 500)
    {
        console.log('Internal Server Error [500].');
    }
    else
    {
        console.log('Uncaught Error.n' + jqXHR.responseText);
    }
});
});
>>>>>>> origin/master
