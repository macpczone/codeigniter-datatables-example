<!doctype html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.jqueryui.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"><?php echo $title ?></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php if (!empty($messages)) { echo $messages; } ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
	    </div>
        </div>
		<form action="<?php echo site_url('example/deletechecks') ?>" method="post" enctype="multipart/form-data" name="frm-example" id="frm-example">
       <table class="table table-bordered table-striped display select cell-border" id="mytable">
            <thead>
  				<tr>
  					<td></td>
   					<td><input type="text" class="topbox"></td>
  					<td><input type="text" class="topbox"/></td>
  					<td><input type="text" class="topbox"/></td>
 					<td><input type="text" class="topbox"/></td>
  					<td><input type="text" class="topbox"/></td>
  					<td><input type="text" class="topbox"/></td>
  					<td></td>
  				</tr>
                <tr>
		    <th aria-label="" style="width: 16px;" colspan="1" rowspan="1" class="dt-body-center sorting_disabled"><input name="select_all" value="1" type="checkbox"></th>
		    <th>Firstname</th>
		    <th>Lastname</th>
		    <th>Address</th>
		    <th>Area</th>
		    <th>Postcode</th>
		    <th>Age</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            </tbody>
            <tfoot>
                <tr>
		    <th aria-label="" style="width: 16px;" colspan="1" rowspan="1" class="dt-body-center sorting_disabled"><input name="select_all" value="1" type="checkbox"></th>
		    <th>Firstname</th>
		    <th>Lastname</th>
		    <th>Address</th>
		    <th>Area</th>
		    <th>Postcode</th>
		    <th>Age</th>
		    <th>Action</th>
                </tr>
            </tfoot>
        </table>
		<p class="form-group">
		   <button type="submit" class="btn btn-primary">Delete Checked</button>
		</p>

		<p class="form-group">
		   <b>Data submitted to the server:</b>
		   </p><pre id="example-console"></pre>
		<p></p>

		</form>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.jqueryui.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jQuery.dtplugin.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/zjs.utils.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/checkboxes.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var rows_selected = [];
				var table = $("#mytable").dataTable({
        			"dom": '<"top"if<"clear">lp>rt<"bottom"ip<"clear">f>',
					processing: true,
			        serverSide: true,
					"lengthMenu": [5, 10, 25, 50, 1000, 5000],
			        ajax: {
			            "url": "<?php echo site_url('/example/dataTable') ?>",
			            "type": "POST"
			        },
			        columns: [
			        	{ data: "p.id" },
			        	{ data: "p.firstname" },
			        	{ data: "p.lastname" },
			        	{ data: "p.address" },
			        	{ data: "p.area" },
			        	{ data: "p.postcode", className: "t_postcode" },
			        	{ data: "p.age", className: "t_age" },
			        	{ data: "p.id" },
			        ],
				    'columnDefs': [{
				       'targets': 0,
				       'searchable': false,
				       'orderable': false,
				       'className': 'dt-body-center',
				       'render': function (data, type, full, meta){
				           return '<input type="checkbox">';
				       }
				    }],
				    'order': [[1, 'asc']],
				    'rowCallback': function(row, data, dataIndex){
				       // Get row ID
				        var rowId = data.DT_RowId;

				        // If row ID is in the list of selected row IDs
				        if($.inArray(rowId, rows_selected) !== -1){
				            $(row).find('input[type="checkbox"]').prop('checked', true);
				            $(row).addClass('selected');
				        }
				    }
				}).dataTableSearch(500);

   // Handle click on checkbox
   $('#mytable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.api().row($row).data();
//	  console.log(data);
//	  console.log(data.DT_RowId);

      // Get row ID
      var rowId = data.DT_RowId;

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

	  console.log(rows_selected);
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#mytable').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('#mytable thead input[name="select_all"]').on('click', function(e){
      if(this.checked){
         $('#mytable tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#mytable tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });

   // Handle form submission event
   $('#frm-example').on('submit', function(e){
      var form = this;
      var b=0;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
         b++;
      });
      console.log("num form inputs is " + b);
   });
            });
        </script>
    </body>
</html>
