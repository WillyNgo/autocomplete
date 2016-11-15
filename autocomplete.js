my = {};
function init(){
    my.searchKey = null;
    $(function() {
        $("#searchBar").keyup(function(){
            var keyword = $("#searchBar").val();
            
            my.searchKey = $.ajax({
                url: "ajax.php",
                data: {'keyword': keyword},
                type: "GET",
                dataType: "text",
                //result from json_encode
                success: function(result){
                    var datalist = document.getElementById("history");
                    //empty history container to avoid over appending
                    datalist.innerHTML = null;
                    var received = JSON.parse(result);
                    for(var i = 0; i < received.length; i++) {
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