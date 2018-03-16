
//send message window opening
$('#co_sendMessageFab_help').click(function(){
    $('#co_sendMessageFormBlock_help, .co_blueWindowArrowBottomRight').fadeIn();
});

$('#co_sendMessageWindowClose_help').click(function(){
    $('#co_sendMessageFormBlock_help, .co_blueWindowArrowBottomRight').fadeOut();
});

var discussionModal = $('#co_discussionModalContainer_help');
//modal discussion
$('.co_openDiscussionModalButton_help').click(function() {
    discussionModal.css('display', 'flex');
    discussionModal.animate({
        opacity: 1
    });
});

$('#co_modalDiscussionCloseButton').click(function(){
    discussionModal.animate({
        opacity:0
    }, function(){
        $('#co_discussionModalContainer_help').css('display', 'none');
    });
});

