$(document).ready ->	
    $('p.lead+p').hide()
    $('.more a').click ->
            $('p.lead+p').slideUp('slow')
            $(this).parent().parent().next().slideDown('slow');
            return false
    $('#portfolio').cycle();

