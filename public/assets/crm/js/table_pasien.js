var table_pasien = function () {
    return {

        //main function to initiate the module
        initDefault: function (url, header, order, sort) {
            var grid = new Datatable();

            grid.init({
                src: $("#table_pasien"),
                onSuccess: function (grid) {
                    
                    //selesai load datatable
                    var tot_idr = grid.getDataTable().ajax.json().tot_idr;
                    $('#total_idr').text("Rp. "+tot_idr);
                    var tot_usd = grid.getDataTable().ajax.json().tot_usd;
                    $('#total_usd').text("$ "+tot_usd);
                    var tot_charge = grid.getDataTable().ajax.json().tot_charge;
                    $('#total_charge').text("$ "+tot_charge);
                    

                },
                onError: function (grid) {
                    // execute some code on neertwork or other general error  
                },
                onDataLoad: function(grid) {
                    // execute some code on ajax data load
                    $('.tooltips').tooltip();
                },
                dataTable: {
                    "aoColumns": header,
                    "bStateSave": true,
                    "pageLength": 10,
                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] 
                    ],
                    "ajax": {
                        "url": url,
                    },
                    "aoColumnDefs": [
                      { "bSortable": false, "aTargets": sort }
                    ],

                    //scroling untuk freeze
                    "scrollX":true,
                    "scrollY":"500px",
                    "scrollCollapse": true,

                    //untuk simpan parameter di localstorage
                    "fnStateSaveParams": function (oSettings, oData) {

                        $('.table_pasien .form-filter').each(function(index, el) {
                            var name = $(el).attr('name');
                            var val = $(el).val();
                            if($(this).val() != ''){
                                if(val != null){
                                    oData[name] = val;
                                }
                            }
                        });

                        $('.table_pasien .global-filter').each(function(index, el) {
                            var name = $(el).attr('name');
                            var val = $(el).val();
                            if($(this).val() != ''){
                                if(val != null){
                                    oData[name] = val;
                                }
                            }
                        });

                        localStorage.setItem( 'DataTables_table_pasien_'+window.location.pathname, JSON.stringify(oData) );
                    },

                    //load parameter dari localstorage
                    "fnStateLoadParams": function(){
                        var filter = false;
                        var data = JSON.parse( localStorage.getItem('DataTables_table_pasien_'+window.location.pathname) );
                        $('.table_pasien .form-filter').each(function(){
                            var name = $(this).attr('name');
                            if(data[name] !== undefined){
                                if(data[name] != null){
                                    if($(this).val() == ''){
                                        $(this).val(data[name]);
                                        if($(this.getDetails).hasClass("select-filter")){
                                            $(this).trigger('change');
                                        }
                                    }
                                    filter = true;
                                }
                            }
                        });

                        $('.table_pasien .global-filter').each(function(){
                            var name = $(this).attr('name');
                            if(data[name] !== undefined){
                                if($(this).val() == ''){
                                     $(this).val(data[name]);
                                }
                            }
                        });

                        if(filter){
                            $('.table_pasien .filter').show();
                            // window.reload_table_pasien();
                        }
                    },
                    "order": order
                }
            });

            // Trigger filter jika klick enter pada input
            grid.getTableWrapper().on('keyup', '.form-filter', function (e) {
                if(e.keyCode == 13){
                    $('.table_pasien .filter-submit').first().click();
                }
            });

            // Trigger filter jika pilih select
            grid.getTableWrapper().on('change', 'select.form-filter, .select-filter', function (e) {
                $('.table_pasien .filter-submit').first().click();
            });

            //untuk reload table
            gridT = grid;
            grid_table_pasien = grid;
            
            window.reload_table_pasien = function (){
                grid_table_pasien.getDataTable().ajax.reload(null, false);
            }
        }
    };

}();