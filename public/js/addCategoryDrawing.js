lastIndex = 0;

if ($('#drawing_categorie').has('.form-group'))
{
    $('#drawing_categorie .form-group input').each(function(index, value)
    {
        lastIndex = parseInt($(value).attr('id').substring(18, 19)) + 1;
    });
}

$('#add-category').click(function (){
    $('#drawing_categorie').append($('#drawing_categorie').data('prototype').replace(/__name__/g, lastIndex));
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