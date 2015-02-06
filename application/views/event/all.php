

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Events

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>event/add">
                    Add new
                  </a>
                </span>
              </h4>

            </div>

            <div class="table-responsive">

<?php if(!empty($rows)): ?>
<table class='table table-striped'>
<thead>
<tr>
<th>Title</th>
<th>Order</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($rows as $row): ?>
<tr>
<td><?php echo word_limiter(strip_tags($row->title),3); ?></td>
<td><?php echo $row->order; ?></td>
<td><?php echo date('Y-m-d',$row->created); ?></td>
<td><a  href='<?php echo base_url()._INDEX; ?>event/edit/<?php echo $row->slug; ?>'  ><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a  onclick='return confirm("Are you sure ?");' href='<?php echo base_url()._INDEX; ?>event/delete/<?php echo $row->slug; ?>' ><i class="glyphicon glyphicon-remove"></i></a></td></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
	<p  align="center">
	<br>
		No record found.
	</p>
<?php endif; ?>

            <div>

              <?php echo $pagination; ?>

            </div>

          </div>

          </div>         

        </div>

      </div>

    </div>