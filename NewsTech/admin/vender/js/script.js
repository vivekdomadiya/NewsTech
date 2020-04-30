// loader

var div_box = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(div_box);

$('#load-screen').delay(700).fadeOut(10, function(){
    $(this).remove();
});


//modal post id
$(".openDeleteModal").click( function() {
    $("#deleteModal #delete_id").val($(this).data('id'));
});


// select all check boxes
$('#selectAllBoxes').click(function(e){
    if(this.checked) {
        $('.checkBoxes').each(function(){
            this.checked = true;
        })
    } else {
        $('.checkBoxes').each(function(){
            this.checked = false;
        })
    }
});