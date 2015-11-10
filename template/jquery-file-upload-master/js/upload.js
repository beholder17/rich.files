$(document).ready(function(){
    $('#fileupload').fileupload({
    dataType: 'json',
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('.progress .bar').css('width', progress + '%'); },
    done: function (e, data) {
        if(data.result.error != undefined){
        $('#error').html(data.result.error); // выводим на страницу сообщение об ошибке если оно есть        
        $('#error').fadeIn('slow');
        }else{
             $('#error').hide(); //на случай если сообщение об ошибке уже отображалось
             $('#files').append("<img class='img-polaroid' style='margin-left:15%;padding:10px;width:auto;height:250px' src=''>");
                $('#success').fadeIn('slow');
            }
        }
    }
});  
});