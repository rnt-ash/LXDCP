$( document ).ready(
    activateGadgets()
);

function activateGadgets() {
    activateConfirmButton(),
    activateToolTips(),
    activatePopovers(),
    activatePending(),
    preventToggleInSubpanel()
}

function activateConfirmButton() {
    $(".confirm-button").click(function(){
        var link = $(this).attr("link"); 
        var text = $(this).attr("text"); 
        bootbox.confirm({
            message: text,
            size: 'small',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> No',
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Yes',
                },
            },
            callback: function (result) {
                if(result){
                    window.location = link;
                    loadingScreen();
                }
            } 
        });
    });
}

function activateToolTips() {
    $('[data-toggle="tooltip"]').tooltip()
}

function activatePopovers() {
    $('[data-toggle="popover"]').popover();
}

function toggleIcon(icon,event) {
    $(icon).toggleClass('fa fa-chevron-down fa fa-chevron-right');
}

function toggleSectionState(slideSectionId,controller,defaultState,event){
    if(!$(event.target).hasClass('dropdown-toggle')){
        toggleIcon('#'+slideSectionId+'_icon',event);
        $.ajax({
            url: '/'+controller+'/toggleSectionState/'+slideSectionId+'/'+defaultState
        })
    }
}

function toggleSlidePanel(panel) {
    $(panel).toggleClass('panel panel-default panel panel-primary');
}

function loadingScreen() {
    $('body').append(
        "<div class='loaderBackground'>"+
            "<div class='spinnerWrapper'>"+
                "<div class='spinner'>"+
                    "<i class='fa fa-spinner fa-pulse fa-5x fa-fw'></i>"+
                    "<div class='loaderText'>Loading ...</div><br /><br />"+
                "</div>"+
            "</div>"+
        "</div>"
    );
    $('body').css("overflow","hidden");
}

function activatePending() {
    $("div.pending").find(".btn.pending").addClass("disabled");
}

function preventToggleInSubpanel() {
    $(".sub-panel .panel-heading a, .sub-panel .panel-heading .btn").not(".dropdown-toggle").click(function(event){
        if($(this).hasClass('loadingScreen')){
            loadingScreen();
        }
        event.stopPropagation();
    });
}