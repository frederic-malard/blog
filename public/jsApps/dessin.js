$app = $('#appweb');

$header = $('<div></div>');
$header.addClass('card-header');

$messagePalette = $('<p></p>');
$messagePalette.text('Palette de couleurs');
$messagePalette.addClass('text-center');
$messagePalette.addClass('h3');

$palette = $('<div></div>');
$palette.css('width', '100%');
$palette.css('border', '1px solid black');
$palette.addClass('row');

$couleurs = ['white', 'black', 'red', 'blue', 'green', 'yellow', 'brown', 'grey', 'cyan', 'pink', 'purple', 'orange'];

$choix = 'black';

$.each($couleurs, function (i, couleur)
{
    $case = $('<button></button>');
    $case.prop('id', couleur);
    $case.css('background', couleur);
    $case.css('color', couleur);
    $case.css('height', '30px;');
    $case.text('i');
    $case.addClass('col-1');

    $case.click(function(){
        $choix = $(this).css('color');
    });

    $palette.append($case);
});

$header.append($messagePalette);
$header.append($palette);

$body = $('<div></div>');
$body.addClass('card-body');
$body.addClass('row');

for($i=0 ; $i<144 ; $i++)
{
    $pixel = $('<button></button>');
    $pixel.text('i');
    $pixel.addClass('col-1');
    $pixel.css('border');

    $pixel.click(function (){
        $(this).css('color', $choix);
        $(this).css('background', $choix);
    });

    $body.append($pixel);
}

$app.append($header);
$app.append($body);

