my = {};
function init(){
    showSuggestions();
}

/**
 * For every keyup, this function will send a request to a php file that will
 * fetch all the city that matches with the term in the search
 * 
 * @returns 
 */
function showSuggestions(){
    my.searchKey = null;
    $(function() {
        $("#searchBar").keyup(function(){
            var keyword = $("#searchBar").val().trim();
            my.searchKey = $.ajax({
                url: "ajax.php",
                data: {'keyword': keyword},
                type: "GET",
                dataType: "text",
                //result from json_encode
                success: function(result){
                    console.log(result);
                    var datalist = document.getElementById("history");
                    //empty history container to avoid over appending
                    datalist.innerHTML = null;
                    var received = JSON.parse(result);
                    for(var i = 0; i < received.length; i++) {
                        //city is an city object
                        var city = received[i];
                        var option = document.createElement("OPTION");
                        var item = document.createTextNode(city['cityname']);
                        
                        //Add item to history data list
                        option.appendChild(item);
                        datalist.appendChild(option);
                    } 
               }
            });
        });
    });
}
window.onload = init;