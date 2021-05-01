    <style type="text/css">
      .table-wrap thead tr th, .table-wrap thead tr td, .table-wrap tbody tr td { white-space: nowrap; } 
      .dataTables_scrollHeadInner{ padding-left:0px !important;}
      .DTFC_RightHeadBlocker { background: #eee; border: 1px solid #eee;}
      .DTFC_RightBodyLiner { overflow-y: none;}
      .filter td{ padding: 0px !important;}
    </style>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light datatable">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Table <?php echo $setting['pagetitle']?></span>
                </div>
                <div class="actions">
    
                    <a href="<?=site_url($setting['url'].'show_add')?>" class="ajaxify btn green-meadow tooltips" data-original-title="Tambah Data" data-placement="top" data-container="body"><i class="fa fa-plus"></i></a>
                    <a href="javascript:;" class="btn btn-sm yellow-crusta btn_show_filter tooltips" data-original-title="Cari" data-placement="top" data-container="body"><i class="fa fa-search"></i></a>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-wrap" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="40px">No</th>
                            <th>Task</th>
                            <th>Category</th>
                            <th width="130px">Action</th>
                        </tr>
                        <tr role="row" class="filter display-hide">
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="task" placeholder="task">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="category" placeholder="category">
                            </td>
                            <td class="text-center">
                                <button data-original-title="Search" class="tooltips btn btn-sm yellow-crusta filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                <button data-original-title="Reset" class="tooltips btn btn-sm red-sunglo filter-cancel"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var urlM = '';

            jQuery(document).ready(function() {
                var url = "<?=site_url($setting['url'].'table_question3')?>";
                var header = [
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" }
                ];
                var order = [
                    [1, "desc"]
                ];
                var sort = [-1,0];

                TableAjax.initDefault(url, header, order, sort);
            });
        </script>
    </div>
</div>