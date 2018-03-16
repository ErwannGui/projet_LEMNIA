$('#close').hide();
$('.ma_modifier_info_perso').hide();
$('#validerInfos').hide();
$('#validerInfosCo').hide();
$('#closeInfosCo').hide();
$('#closeSepa').hide();
$('#ma_modifier_infos_co').hide();
$('#validerSepa').hide();
$('#ma_modifier_sepa').hide();
$('#addCard').hide();
// modification des informations personnels
$('#ma_modif_info_perso').click(function(){
    if ($('#ma_info_perso').hasClass('ma_modifyBackground')){
        $('#ma_info_perso').removeClass('ma_modifyBackground')
        $('#ma_title_infos_perso').removeClass('white-text');
        $('#ma_initial_info_perso').removeClass('black-text');
        $('#ma_initial_info_perso').addClass('white-text');
        $('#ma_nameCircle').addClass('co_nameCircle');
        $('#ma_nameCircle').removeClass('ma_nameCircle_modify');
        $('#edit').show();
        $('#close').hide();
        $('.ma_apercu_info_perso').show();
        $('.ma_modifier_info_perso').hide();
        $('#validerInfos').hide();
    }else{
    $('#ma_info_perso').addClass('ma_modifyBackground');
    $('#ma_title_infos_perso').addClass('white-text');
    $('#ma_initial_info_perso').addClass('black-text');
    $('#ma_initial_info_perso').removeClass('white-text');
    $('#ma_nameCircle').removeClass('co_nameCircle');
    $('#ma_nameCircle').addClass('ma_nameCircle_modify');
    $('#edit').hide();
    $('#close').show();
    $('.ma_apercu_info_perso').hide();
    $('.ma_modifier_info_perso').show();
    $('#validerInfos').show();
    };
});

// modifications des infos de connexion
$('#ma_modif_info_co').click(function(){
    if ($('#ma_info_co').hasClass('ma_modifyBackground')){
        $('#ma_info_co').removeClass('ma_modifyBackground');
        $('#ma_title_infos_co').removeClass('white-text');
        $('#validerInfosCo').hide();
        $('#closeInfosCo').hide();
        $('#editInfosCo').show();
        $('#ma_modifier_infos_co').hide();
        $('#ma_apercu_infos_co').show();
    }else{
        $('#ma_info_co').addClass('ma_modifyBackground');
        $('#ma_title_infos_co').addClass('white-text');
        $('#closeInfosCo').show();
        $('#editInfosCo').hide();
        $('#validerInfosCo').show();
        $('#ma_modifier_infos_co').show();
        $('#ma_apercu_infos_co').hide();
    };
});

// modifications du mandat sepa
$('#ma_modif_sepa').click(function(){
    if ($('#ma_sepa').hasClass('ma_modifyBackground')){
        $('#ma_sepa').removeClass('ma_modifyBackground');
        $('#ma_title_sepa').removeClass('white-text');
        $('#validerSepa').hide();
        $('#closeSepa').hide();
        $('#editSepa').show();
        $('#ma_modifier_sepa').hide();
        $('#ma_apercu_sepa').show();
    }else{
        $('#ma_sepa').addClass('ma_modifyBackground');
        $('#ma_title_sepa').addClass('white-text');
        $('#closeSepa').show();
        $('#editSepa').hide();
        $('#validerSepa').show();
        $('#ma_modifier_sepa').show();
        $('#ma_apercu_sepa').hide();
    };
});

$('#addNewCard').click(function(){
    $('#addNewCard').hide();
    $('#addCard').show();
    $( "#addCard" ).animate({
        top: "+=200"
    }, "slow", function() {
        $('#addCard').css('z-index','0');
    });
});

//Canvas signature pad
var canvas = document.querySelector("canvas");
var signaturePad = new SignaturePad(canvas);
var canvaConverti = canvas.toDataURL();

canvas.addEventListener('mouseup', function(){
    var canvaConverti = canvas.toDataURL();
    $('#form_signature').attr({value : canvaConverti});
});




