/***************************************************************************************************
PopupWindow - The ultimate popup/dialog/modal jQuery plugin
    Author          : Gaspare Sganga
    Version         : 1.0.3
    License         : MIT
    Documentation   : http://gasparesganga.com/labs/jquery-popup-window/
***************************************************************************************************/
$(document).ready(function(){
    var me = $('#tabView-content-body');
    $.each(popupWindowArr, function(index, value) {
        me.prepend("<div id='"+value.id+"' windowId='"+value.id+"'  style='overflow: hidden !important;' class='example_content windowContainer'><nav></nav><div class='tab-content' id='nav-tabContent'><div class='tab-pane fade show active' tableId='#tbl-"+value.id+"' id='nav-"+value.id+"' role='tabpanel' aria-labelledby='nav-"+value.id+"-tab'></div></div></div>")
    });
})
function popUpWindow (me, val){   
    // console.log(me);    
    // console.log(val);    
    var id = me.attr('id').slice(0,-4),
            frmTitle = me.attr('title'),
            href = me.attr('action');
            idplus = "#nav-"+id+"";
            var tableAttr = me.closest('table').attr('id');
            var height= val.height?val.height:500,
                width = val.width? val.width:1000;
        $.get(href, function(result) {
            // alert('halo');
            $(idplus).html(result);
            $("#"+id+"").PopupWindow("settitle", frmTitle).PopupWindow("open");
            
        });
        $("#"+id+"").PopupWindow({
            title               : 'Data',
            modal               : false,
            autoOpen            : false,
            animationTime       : 300,
            customClass     : "custom_style",
            buttons             : {
                close               : true,
                maximize            : true,
                collapse            : true,
                minimize            : true
            },
            buttonsPosition     : "right",
            buttonsTexts        : {
            close               : "Close",
            maximize            : "Maximize",
            unmaximize          : "Restore",
            minimize            : "Minimize",
            unminimize          : "Show",
            collapse            : "Collapse",
            uncollapse          : "Expand"
            }, 
            draggable           : true,
            nativeDrag          : true,
            dragOpacity         : 0.6,
            resizable           : true,
            resizeOpacity       : 0.6,
            statusBar           : true,
            top                 : "auto",
            left                : "auto",
            height              : height,
            width               : width,
            maxHeight           : undefined,
            maxWidth            : undefined,
            minHeight           : 300,
            minWidth            : 400,
            collapsedWidth      : undefined,
            keepInViewport      : false,
            mouseMoveEvents     : true
        });
}