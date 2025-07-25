function dataTableFc(dataTable, val) {
    var idTable = dataTable[0].idTable,
        tblColumns = dataTable[0].tblColumns,
        // btnNames = dataTable[0].btnNames,
        value = val == undefined?"":val,
        url = dataTable[0].url,
        dataTableArr = dataTable[1].data,
        method = dataTable[0].method,
        bPaginate = dataTable[0].bPaginate,
        destroy = dataTable[0].destroy ? dataTable[0].destroy : false;

    var token = val._token == undefined ? '' : val._token;
    var data = val == undefined ? {_token: token, method: 'GET'} : val;
    var iconPrint = [
        {icon:"fa fa-clone", titleAttr:"copy"}, {icon:"fa fa-file-excel", titleAttr:"excel"},
        {icon:"fa fa-file-pdf", titleAttr:"pdf"}, {icon:"fa fa-print", titleAttr:"print"}];
    var ajax = method == 'GET' ? url : {
        'type': method,
        'url': url,
        'data': data,
    };

    var tblButtons = [],
        dataTableArrNew = [],
        iconPrintArr = [];

    // btnNames.map(item => {
    //     return tblButtons.push({
    //         extend: item,
    //         exportOptions: {
    //             columns: tblColumns
    //         }
    //     });
    // });

    // dataTableArr.map(item => {
    //     return dataTableArrNew.push({
    //         data: item.data,
    //         name: item.data,
    //         className: item.className ? item.className : false,
    //         render: item.render ? $.fn.dataTable.render.number('.', '.', '') : false
    //     });
    // });

    dataTableArr.map(item => {
        let columnConfig = {
            data: item.data,
            name: item.data,
        };

        if (item.className) columnConfig.className = item.className;
        if (item.render) columnConfig.render = item.render; // ✅ gunakan render yg dikirim
        if (item.width) columnConfig.width = item.width;     // ✅ tambahkan ini

        return dataTableArrNew.push(columnConfig);
    });


    iconPrint.map(item => {
        return iconPrintArr.push({
            "extend": item.titleAttr,
            "text": '<i class="'+item.icon+'" style="color: white;"></i>',
            "titleAttr": item.titleAttr,
            "exportOptions": {
                columns: tblColumns
            },
            "action": newexportaction
        });
    });

    var iconPrintArrNew = dataTable[0].noBtnPrint == true ? false : iconPrintArr;

    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;

        dt.one('preXhr', function (e, s, data) {
            data.start = 0;
            data.length = 2147483647;

            dt.one('preDraw', function (e, settings) {
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action.call(self, e, dt, button, config);
                }

                dt.one('preXhr', function (e, s, data) {
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                setTimeout(dt.ajax.reload, 0);
                return false;
            });
        });

        dt.ajax.reload();
    };

    var table = $(idTable).DataTable({
        // responsive: true,
        scrollX: true,
        scrollY: '250px',
        lengthChange: false,
        autoWidth: true,
        searching: false,
        bDestroy: destroy,
        bPaginate: bPaginate,
        pageLength: dataTable[0].pageLength ?? 10,
        bInfo: false,
        ajax: ajax,
        columns: dataTableArrNew,
        buttons: tblButtons,
        initComplete: function(settings, json) {
            table.buttons().container().appendTo(idTable + '_wrapper .col-md-6:eq(0)');
        }
    });
};
