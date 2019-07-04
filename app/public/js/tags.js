var $collectionHolder;

$(document).ready(function() {
    $collectionHolder = $('ul.tags');
    $addbtn = $('.js-tags-add');

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    $addbtn.on('click', function (e) {
        e.preventDefault();
        addTagForm($collectionHolder, $addbtn);   
    });
});

function addTagForm($collectionHolder) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    $newFormLi = $('<li></li>').append(newForm);

    addTagFormDeleteLink($newFormLi);

    $collectionHolder.append($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">x</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}