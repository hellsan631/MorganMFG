<section id="content">
<section class="vbox">
<section class="scrollable wrapper">
<div class="tab-content">
<section class="tab-pane active" id="basic">
<div class="row">
<div class="col-sm-12">
<?php alert(); ?>

<section class="panel">
    <header class="panel-heading font-bold">
        Remove Module
    </header>
    <div class="panel-body">
    <?php echo form_open(cms_current_url(), array('role'=>'form')) ?>
        <div class="form-group">
            <label>Module Name</label>
            <input required='required' style='width:400px;' type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>">  
            <span style="color: red; font-size: 12px; font-style: italic;"> <?php echo form_error('name') ?> </span>           
        </div>

        <button style='margin-top:50px;' type="submit" class="btn btn-sm btn-default">Remove Module</button>
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