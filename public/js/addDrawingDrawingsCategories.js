lastIndex = 0;

if ($('#category_drawing_complete_dessin').has('.form-group'))
{
    $('#category_drawing_complete_dessin .form-group input').each(function(index, value)
    {
        lastIndex = parseInt($(value).attr('id').substring(33, 34)) + 1;
    });
}

$('#add-drawing').click(function (){
    $('#category_drawing_complete_dessin').append($('#category_drawing_complete_dessin').data('prototype').replace(/__name__/g, lastIndex));
    handleDeleteButtons();
    lastIndex++;
});

function handleDeleteButtons()
{
    $('button[data-action="delete"]').click(function(){
        $(this.dataset.target).remove();
    });
}

handleDeleteButtons();