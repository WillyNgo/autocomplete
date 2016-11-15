var MIN_LENGTH = 3;
$(document).ready(function () {
    $("#search").keyup(function () {
        var keyword = $("#search").val();
        if (keyword.length >= MIN_LENGTH) 
        {
            $.get("index.php", {keyword: keyword}).done(function (data) 
            {console.log(data);
                        var results = jQuery.parseJSON(data);
                        $(results).each(function (key, value) {
                            $('#results').append('<div class="item">' + value + '</div>');
                        });

                        $('.item').click(function () {
                            var text = $(this).html();
                            $('#search').val(text);
                        });
            });
        } else {
            $('#results').html('');
        }
    });
    $("#search").blur(function () {
        $("#results").fadeOut(500);
    })
            .focus(function () {
                $("#results").show();
            });
});