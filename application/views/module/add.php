<script>
	onload = function(){
		$('#sidebar').remove();
	}
</script>

<section id="">
<section class="vbox">
<section class="scrollable wrapper">
<div class="tab-content">
<section class="tab-pane active" id="basic">
<div class="row">
<div class="col-sm-12">
<?php alert(); ?>

<section class="panel">
    <header class="panel-heading font-bold">
        Create Module
    </header>
    <div class="panel-body">
    <?php echo form_open(cms_current_url(), array('role'=>'form')) ?>
        <div class="form-group">
            <label>Module Name</label>
            <input required='required' style='width:400px;' type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>">  
            <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('name') ?> </span>           
        </div>

        <div class="form-group">
            <label>Table Detail</label>
            <div class="form-group">
                <label>Total number of fields <span style='font-weight:lighter; color:#E75D59;'> (Here <b>'Id,Slug,Created and Updated'</b> fields will be created automatically.)</span></label>
                <div style='clear:both;'></div>
                <input required='required' style=' float:left; width:200px;' type="text" class="form-control" name="total" value="<?php echo set_value('total'); ?>">  
                <a onclick='create_fields()' style='float:left; width:200px;' class="btn btn-danger">Create Fields</a>
                <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('total') ?> </span>           
                <div style='clear:both;'></div>
            </div>
        </div>
    <div id='dynamic_fields' class="form-group"></div>

    <div class="form-group">
        <a onclick='create_form_fields()' class='btn btn-danger' style='width:200px;'>Update Form Fields</a>
    </div>
    <div id='form_fields' class="form-group">
    </div>

        <button onclick='faraz();' style='margin-top:50px;' type="submit" class="btn btn-lg btn-success">Create Module</button>
    <?php echo form_close(); ?>
    </div>
</section>

</div>
</div>
</section>
</div>
</section>
</section>
</section>

<script>
function create_fields()
{
    var total = $('input[name=total]').val();
    var i;
    var new_content = '';
    for(i=1; i<=total; i++)
    {
        new_content += "<div id='"+i+"' class='db_table'>";
        new_content += "<input name='fname[]' required='required' type='text' class='fname form-control' style='float:left; width:200px;' placeholder='Field Name'>";
        new_content += "<select name='ftype[]' class='ftype form-control' style='width:100px; float:left;  margin-left:20px;'><option>int</option><option>varchar</option><option>text</option><option>date</option></select>";
        new_content += "<input value='11' type='text' name='fsize[]' class='fsize form-control' style='width:60px; float:left;  margin-left:20px;  required='required' placeholder='Size'>";
        new_content += "</div>";
        new_content += "<div style='clear:both;'><br></div>";
    }
    $('#dynamic_fields').html(new_content);
}
</script>

<script>
function create_form_fields()
{
    var total = $('input[name=total]').val();
    if(total==''){
        alert('Please create table first.');
        $('input[name=total]').focus();
        return;
    }


    var slug_field_select = "<select name='slug_as' class='form-control' style='width:200px;  float:left;' required='required'>";
    slug_field_select += "<option value=''>Select Field</option>";
    $('.db_table').each(function(){
        id = $(this).attr('id');
        fname = $('#'+id+' .fname').val().toLowerCase();
        slug_field_select += "<option>"+fname+"</option>";
    });
    slug_field_select += "</select>";


    var i = 1;
    var form_content = slug_field_select;
    form_content += "<div style='float:left; font-size:16px; margin-left:20px;'>Please select a field to use as a slug.</div>";
    form_content += "<div style='clear:both;'><br></div>";
    form_content += "<table class='fzTable'>"; 
    form_content += "<tr><th>Display Name</th><th>Field Type</th><th>Validation Rule</th><th>File types in csv</th><th>File size in mb</th><th>Match With</th><th>Min Length</th><th>Max Length</th><th>Exact Length</th></tr>"; 
    form_content += ""; 
    $('.db_table').each(function(){
        id = $(this).attr('id');
        fname = $('#'+id+' .fname').val().toLowerCase();
        form_content += "<tr id='tr_id_'"+i+">";
        form_content += "<td><input type='text' name='display_name_"+i+"' class='form-control' style='width:150px;' placeholder='Display Name' value='"+fname+"' required></td>";
        form_content += "<td><select name='type_"+i+"' class='form-control' style='width:110px;' required><option>Text</option><option>Textarea</option><option>Email</option><option>Password</option><option>File</option><option>Select</option></select></td>";
        
        form_content += '<td>';
        form_content += "<select name='validation_"+i+"[]' style='width:147px; margin-top:10px;' class='form-control' multiple='multiple' required='required'>";
        form_content += "<option value='0' selected>No Validation</option>";
        form_content += "<option value='100'>File Required</option>";
        form_content += "<option value='200'>File Validation</option>";
        form_content += "<option value='1'>Required</option>";
        form_content += "<option value='2'>Valid email</option>";
        form_content += "<option value='3'>Unique</option>";
        form_content += "<option value='4'>Matches with</option>";
        form_content += "<option value='5'>Min length</option>";
        form_content += "<option value='6'>Max length</option>";
        form_content += "<option value='7'>Exact length</option>";
        form_content += "<option value='8'>Numeric</option>";
        form_content += "<option value='9'>Alpha-Numeric</option>";
        form_content += "<option value='10'>Alpha</option>";
        form_content += "<option value='11'>Integer</option>";
        form_content += "<option value='12'>Decimal</option>";
        form_content += "</select>";
        form_content += '</td>';

        form_content += '<td>';
        form_content += "<input name='allowed_file_types_"+i+"' type='text' style='width:150px;' value='png,jpeg,gif,jpg' class='form-control' required='required'>";
        form_content += '</td>';

        form_content += '<td>';
        form_content += "<input name='allowed_file_size_"+i+"' type='text' style='width:80px;' value='10' class='form-control' required='required'>";
        form_content += '</td>';

        match_field_select = "<select name='match_"+i+"' class='form-control' style='width:150px;'>";
        $('.db_table').each(function(){
            id = $(this).attr('id');
            fname = $('#'+id+' .fname').val().toLowerCase();
            match_field_select += "<option>"+fname+"</option>";
        });
        match_field_select += "</select>";
        form_content += "<td>"+match_field_select+"</td>";

        form_content += "<td><input value='6' name='min_"+i+"' class='form-control' style='width:80px;'></td>";
        form_content += "<td><input value='8' name='max_"+i+"' class='form-control' style='width:80px;'></td>";
        form_content += "<td><input value='12' name='exact_"+i+"' class='form-control' style='width:80px;'></td>";
        form_content += "</tr>";
        i++;
    });
    form_content += "</table>"; 
    $('#form_fields').html(form_content);
}
</script>
<style>
    .fzTable tr th{
        width:200px;
    }
</style>  
