
//Add contact window opening
$('#co_fabAddContact_contacts').click(function(){
    $('#co_addContactFormBlock_contacts, .co_blueWindowArrowBottomRight').fadeIn();
});

$('#co_addContactWindowClose_contacts').click(function(){
    $('#co_addContactFormBlock_contacts, .co_blueWindowArrowBottomRight').fadeOut();
});

//Modal Modify contact
$('#modalModify').modal({
    startingTop: '0%', // Starting top style attribute
    endingTop: '0%'// Ending top style attribute
});

