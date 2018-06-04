

function onlyCallToCellphone(){
    var anchors = $(".instructor-tel")

    if ($(window).width() > 515){
        anchors.each(function(anchor)
        { 
            $(this).attr('href', '#')
        });
    }

    $(window).on('resize', () => {
        if ($(window).width() > 515){
            anchors.each(function(anchor)
            { 
                $(this).attr('href', '#')
            });
        }
    })

}





