$index = 0;
if ($('#app_web_competences').children().length > 0)
{
    console.log('dans if');
    $dernier = $('#app_web_competences div:last-child div:last-child textarea:last-child');
    $idDernier = $dernier.attr('id');
    $index = parseInt($idDernier.substring(20, 21)) + 1;
}
$boutonAjout = $('#appWebCompetence');
$boutonAjout.click(function(){
    $formulaire = $('#app_web_competences');
    $template = $formulaire.data('prototype');
    $template = $template.replace(/__name__/g, $index);
    $formulaire.append($template);
    $index++;
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}

handleDeleteButtons();