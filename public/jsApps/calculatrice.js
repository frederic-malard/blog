$app = $('#appweb');

$app.css('margin', 'auto');
$app.css('width', '350px');

$header = $('<div></div>');
$header.addClass('card-header');

$ecran = $('<p></p>');
$ecran.text('0');
$ecran.css('width', '100%');
$ecran.css('border', '1px solid black');
$ecran.addClass('p-2');
$ecran.addClass('text-right');
$ecran.addClass('h3');

$header.append($ecran);

$body = $('<div></div>');
$body.addClass('card-body');
$body.addClass('row');
$body.addClass('mx-1');

$app.append($header);
$app.append($body);

$virgule = false; // true si le dernier nombre écrit possède déjà une virgule (auquel cas impossible d'en rajouter)
$operation = false; // true si le dernier caractère tapé est celui d'une opération, auquel cas impossible d'en rajouter une. Note : si operation est a true et qu'on ajoute une virgule, opération reste a true (pour empêcher d'écrire 2+,+3 par ex)
$profondeurParantheses = 0;

$touches = {
    'pOuvre' : '(',
    'pferme' : ')',
    'divise' : '/',
    'efface' : 'AC',
    'sept' : 7,
    'huit' : 8,
    'neuf' : 9,
    'modulo' : '%',
    'quatre' : 4,
    'cinq' : 5,
    'six' : 6,
    'multiplie' : '*',
    'un' : 1,
    'deux' : 2,
    'trois' : 3,
    'moins' : '-',
    'zero' : 0,
    'point' : '.',
    'egale' : '=',
    'plus' : '+'
};

$.each($touches, function (i, value)
{
    $symbole = value;
    $touches[i] = $('<div></div>');
    $button = $('<button></button>');
    $button.addClass('btn');
    $button.addClass('btn-light');
    $touches[i].addClass('col-3');
    $button.addClass('my-2');
    $button.css('border', '1px solid grey');
    $button.css('width', '100%');
    $button.attr('id', i);
    $button.text($symbole);
    $touches[i].append($button);
    $body.append($touches[i]);
});

function chiffre(event)
{
    if ($ecran.text() == 0)
        $ecran.text('');
    if ($operation)
        $operation = false;
    $ecran.text($ecran.text()+''+event.data.ch);
}

$('#zero').click({ch : 0}, chiffre);
$('#un').click({ch : 1}, chiffre);
$('#deux').click({ch : 2}, chiffre);
$('#trois').click({ch : 3}, chiffre);
$('#quatre').click({ch : 4}, chiffre);
$('#cinq').click({ch : 5}, chiffre);
$('#six').click({ch : 6}, chiffre);
$('#sept').click({ch : 7}, chiffre);
$('#huit').click({ch : 8}, chiffre);
$('#neuf').click({ch : 9}, chiffre);

$('#point').click(function(){
    if (! $virgule && ! $operation)
    {
        $virgule = true;
        $ecran.text($ecran.text()+'.');
    }
});

function operation(event)
{
    if (! $operation)
    {
        $operation = true;
        $virgule = false;
        $ecran.text($ecran.text()+''+event.data.op);
    }
}

$('#divise').click({op : '/'}, operation);
$('#modulo').click({op : '%'}, operation);
$('#multiplie').click({op : '*'}, operation);
$('#moins').click({op : '-'}, operation);
$('#plus').click({op : '+'}, operation);

$('#efface').click(function(){
    $ecran.text(0);
    if (typeof $operation != 'undefined')
    {
        $operation = '';
    }
    if (typeof $nombre != 'undefined')
    {
        $nombre = 0;
    }
    if (typeof $i != 'undefined')
    {
        $i = 0;
    }
    $virgule = false;
});

$('#pOuvre').click(function(){
    $profondeurParantheses++;
    $ecran.text($ecran.text()+'(');
});

$('#pferme').click(function(){
    if ($profondeurParantheses > 0)
    {
        $profondeurParantheses--;
        $ecran.text($ecran.text()+')');
    }
})

function appliquer($n1, $operation, $n2)
{
    switch($operation)
    {
        case '' :
            return $n2;
            break;
        case '+' :
            return $n1 + $n2;
            break;
        case '-' :
            return $n1 - $n2;
            break;
        case '*' :
            return $n1 * $n2;
            break;
        case '/' :
            return $n1 / $n2;
            break;
        case '%' :
            return $n1 % $n2;
            break;
        default :
            return 'erreur : operation inconnue';
    }
}

function calcul($text, $i){
    $length = $text.length;
    $nombre = 0;
    $nTexte = ''; // pour construire facilement un nombre à partir des caractères
    $operation = '';
    for ($i=$i ; $i<$length ; $i++)
    {
        switch($text[$i]) // NOTE : IL FAUDRA QUE JE GERE LES PRIORITES DES OPERATIONS !!! Gérer aussi les nombres négatifs ? Ou demander à l'utilisateur d'écrire '0-2' au lieu de '-2' par exemple ? Gérer aussi les new calculs à partir du résultat du précédent ? Et les multiples opérations de haute priorité d'affilé !
        {
            case '(' :
                // pour une raison qui m'échappe, la portée des variable est faite de sorte que lors de l'appel récursif, il y a continuité temporelle des valeurs des variables, les valeurs de "l'appel interne" sont conservées lorsqu'on retourne au truc externe... ????                
                if (typeof $sauveNombre == 'undefined')
                {
                    $sauveNombre = [];
                    $sauveOperation = [];
                }

                $sauveNombre.push($nombre);
                $sauveOperation.push($operation);

                $tab = calcul($text, $i+1);

                $nombre = $sauveNombre[$sauveNombre.length-1];
                $operation = $sauveOperation[$sauveOperation.length-1];

                $sauveNombre.pop();
                $sauveOperation.pop();

                $nombre = appliquer($nombre, $operation, $tab[0]);
                $i = $tab[1];
                $operation = '';
                
                break;
            case ')' :
                return [$nombre, $i];
                break;
            case '*' :
            case '/' :
            case '%' :
            case '+' :
            case '-' :
                $operation = $text[$i];
                break;
            case '0' :
            case '1' :
            case '2' :
            case '3' :
            case '4' :
            case '5' :
            case '6' :
            case '7' :
            case '8' :
            case '9' :
            case '.' :
                while ($i < $length && -1 != jQuery.inArray($text[$i], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.']))
                {
                    $nTexte += $text[$i];
                    $i++;
                }
                $i--;
                $nTemp = parseFloat($nTexte); // nombre temporaire = nombre textuel transformé en vrai nombre
                $nTexte = '';
                if ($operation == '')
                {
                    $nombre = $nTemp;
                }
                else
                {
                    $nombre = appliquer($nombre, $operation, $nTemp);
                }
                break;
            default  :
                return 'erreur : caractère inconnu';
        }
    }
    return $nombre;
}

function initiationCalcul(event)
{
    // réécriture du texte avec paranthèses autour des opérations prioritaires
    // faire ici
    $text = $ecran.text();
    $length = $text.length;
    $indiceOuvre = 0;
    $indiceFerme = 0;
    for ($i=0 ; $i<$length ; $i++)
    {
        if (-1 != jQuery.inArray($text[$i], ['*', '/', '%']))
        {
            $profondeur = 0;

            $indiceOuvre = $i-1;
            // note : traiter les cas où ces opérateurs sont collés à des paranthèses. Commencer par un if puis enchainer sur un ou un autre while en fonction de si char juste avant op est paranthese ou chiffre ?
            while ($text[$indiceOuvre] == ')' || $profondeur > 0 || ($indiceOuvre >= 0 && -1 != jQuery.inArray($text[$indiceOuvre], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.'])))
            {
                if ($text[$indiceOuvre] == ')')
                    $profondeur++;
                else if ($text[$indiceOuvre] == '(')
                    $profondeur--;
                $indiceOuvre--;
            }
            $indiceOuvre++; // indice ouvre sur premier chiffre du nombre précédent l'opération

            $indiceFerme = $i+1;
            while ($indiceFerme < $length && -1 != jQuery.inArray($text[$indiceFerme], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.']))
            {
                $indiceFerme++;
            }
            // indice ferme sur le caractère qui suit le dernier chiffre du nombre suivant l'opération (potentiellement hors du texte)

            if ($indiceFerme == $length)
                $endText = '';
            else
                $endText = $text.substring($indiceFerme);
            
            $text = $text.substring(0, $indiceOuvre) + '(' + $text.substring($indiceOuvre, $indiceFerme) + ')' + $endText;

            $length += 2;

            $i++
        }
    }
    $ecran.text(calcul($text, 0));
}

$('#egale').click(initiationCalcul);