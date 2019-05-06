// ---------------------------- NOTIFICATIONS -------------------------
var notificationBlockIsVisible = false;
var secondsOnNotificationClick = 0;
$(window).click(function(){
    //Si l'utilisateur ne vient pas juste d'ouvrir la fenêtre de notifications
    if(notificationBlockIsVisible && new Date().getTime() / 1000 > secondsOnNotificationClick + 1){
        closeNotificationTab();
    }
});

$('#co_rightNavNotifications_header').click(function(){
    console.log(notificationBlockIsVisible);
    if(notificationBlockIsVisible){
        closeNotificationTab();
    }else{
        $(this).find('#co_notificationBlock_header').fadeIn();
        notificationBlockIsVisible = true;
        secondsOnNotificationClick = new Date().getTime() / 1000;
    }
});

function closeNotificationTab(){
    $('#co_notificationBlock_header').fadeOut();
    notificationBlockIsVisible = false;
}