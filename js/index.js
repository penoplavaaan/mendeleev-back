$( document ).ready(function() {
    $(".ban-button").on('click',function (){
        let idToBan = $(this).data("id");
        console.log(idToBan);
        $.ajax({
            method: "GET",
            data: {"idToBan":idToBan},
            url: './deleteIdFromTXT.php',
            success: function(data) {
                alert('Element deleted successfully');
                $( ".simple-row" ).each(function( index ) {
                    if($( this ).data("id") === idToBan)
                        this.remove();
                });
            }
        });
    })
});