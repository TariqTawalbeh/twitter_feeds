$('#english_tweets').on('click', e => {tweets(e, 'en')});
$('#arabic_tweets').on('click', e => {tweets(e, 'ar')});

function tweets(e, labguage) {
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: '/ajax/twitter',
        success: function( output ) {
            $("#tweets").empty();
            var obj = JSON.parse(output);
            $(obj).each(function( index, value){
                if(value.lang == labguage){
                    var startTime = new Date(value.created_at);

                    $("#tweets").append(
                        '<ul class="timeline">'+
                            '<li>'+
                                '<a href="#" class="float-right">'+ months[startTime.getMonth()] + ', '+ startTime.getDay() + ' ' + startTime.getFullYear() +'</a>'+
                                '<p>'+value.text+'</p>'+
                            '</li>'+
                        '</ul>'
                    );
                }
            });
        }

    });
}