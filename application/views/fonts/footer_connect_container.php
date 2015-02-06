<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/colorpicker/jscolor.js"></script>
<style type="text/css">
	input,select{
		width:30% !important;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<?php $this->load->view('admin/sidebar'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php echo alert(); ?>          
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Change Footer Connect Fonts <a href="<?php echo base_url() ?>fonts/reset/<?php echo $id ?>" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?');"> Reset to default </a> </h3>
						
				</div>
				<div class="row">              
					<div class="col-sm-11 col-md-10 main">              
						<?php echo form_open_multipart(current_url()); ?>               

							<!-- First Start -->
							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font name</label>
									<select name="f_body_id" class="form-control">
										<option value="">Default</option>
										<?php foreach ($google_fonts as $var) { ?>
										  <option value="<?php echo $var->id ?>" <?php if($var->id == $row->f_body_id) { echo "selected='selected'"; } ?> ><?php echo $var->font_name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>                 

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font size on web</label>
									<select name="f_w_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_w_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font size on mobile</label>
									<select name="f_m_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_m_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font size on tablet</label>
									<select name="f_t_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_t_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="">Heading font color</label>
								<input type="text" class="form-control color" name="f_color" value="<?php echo $row->f_color; ?>">
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font weight</label>
									<select name="f_weight" class="form-control">
										<option value="">Default</option>
										<option value="<?php echo $row->f_weight ?>" selected="selected"><?php echo $row->f_weight ?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font line height</label>
									<select name="f_line_height" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_line_height) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font word spacing</label>
									<select name="f_word_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_word_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Heading font letter spacing</label>
									<select name="f_letter_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->f_letter_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<input type="hidden" id="f_weight" value="<?php echo $row->f_weight ?>">
							<script type="text/javascript">
								$(document).ready(function(){
							        $("select[name=f_body_id]").trigger('change');
							    });

							    $('select[name=f_body_id]').change(function(){
									var val = $(this).val();
									$.ajax({
										method:'POST',
										url:'<?php echo base_url() ?>fonts/get_font_weights/'+val ,
										success:function(res){          
											$('select[name=f_weight]').html(res);
											if($("#f_weight").val() != '0'){
												$('select[name=f_weight]').val($("#f_weight").val());
												$("#f_weight").val(0);
											}
										}
									});        
								});
							</script>

							<!-- First End -->


							
							<!-- Second Start -->
							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font name</label>
									<select name="s_body_id" class="form-control">
										<option value="">Default</option>
										<?php foreach ($google_fonts as $var) { ?>
										  <option value="<?php echo $var->id ?>" <?php if($var->id == $row->s_body_id) { echo "selected='selected'"; } ?> ><?php echo $var->font_name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>                 

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font size on web</label>
									<select name="s_w_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_w_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font size on mobile</label>
									<select name="s_m_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_m_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font size on tablet</label>
									<select name="s_t_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_t_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="">Paragraph font color</label>
								<input type="text" class="form-control color" name="s_color" value="<?php echo $row->s_color; ?>">
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font weight</label>
									<select name="s_weight" class="form-control">
										<option value="">Default</option>
										<option value="<?php echo $row->s_weight ?>" selected="selected"><?php echo $row->s_weight ?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font line height</label>
									<select name="s_line_height" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_line_height) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font word spacing</label>
									<select name="s_word_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_word_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Paragraph font letter spacing</label>
									<select name="s_letter_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->s_letter_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<input type="hidden" id="s_weight" value="<?php echo $row->s_weight ?>">
							<script type="text/javascript">
								$(document).ready(function(){
							        $("select[name=s_body_id]").trigger('change');
							    });

							    $('select[name=s_body_id]').change(function(){
									var val = $(this).val();
									$.ajax({
										method:'POST',
										url:'<?php echo base_url() ?>fonts/get_font_weights/'+val ,
										success:function(res){          
											$('select[name=s_weight]').html(res);
											if($("#s_weight").val() != '0'){
												$('select[name=s_weight]').val($("#s_weight").val());
												$("#s_weight").val(0);
											}
										}
									});        
								});
							</script>

							<!-- Second End -->

							<?php /* // NO USE
							<!-- Third Start -->
							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font name</label>
									<select name="t_body_id" class="form-control">
										<option value="">Default</option>
										<?php foreach ($google_fonts as $var) { ?>
										  <option value="<?php echo $var->id ?>" <?php if($var->id == $row->t_body_id) { echo "selected='selected'"; } ?> ><?php echo $var->font_name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>                 

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font size on web</label>
									<select name="t_w_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_w_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font size on mobile</label>
									<select name="t_m_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_m_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font size on tablet</label>
									<select name="t_t_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_t_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="">Third font color</label>
								<input type="text" class="form-control color" name="t_color" value="<?php echo $row->t_color; ?>">
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font weight</label>
									<select name="t_weight" class="form-control">
										<option value="">Default</option>
										<option value="<?php echo $row->t_weight ?>" selected="selected"><?php echo $row->t_weight ?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font line height</label>
									<select name="t_line_height" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_line_height) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font word spacing</label>
									<select name="t_word_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_word_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Third font letter spacing</label>
									<select name="t_letter_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->t_letter_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<input type="hidden" id="t_weight" value="<?php echo $row->t_weight ?>">
							<script type="text/javascript">
								$(document).ready(function(){
							        $("select[name=t_body_id]").trigger('change');
							    });

							    $('select[name=t_body_id]').change(function(){
									var val = $(this).val();
									$.ajax({
										method:'POST',
										url:'<?php echo base_url() ?>fonts/get_font_weights/'+val ,
										success:function(res){          
											$('select[name=t_weight]').html(res);
											if($("#t_weight").val() != '0'){
												$('select[name=t_weight]').val($("#t_weight").val());
												$("#t_weight").val(0);
											}
										}
									});        
								});
							</script>

							<!-- Third End -->

							<!-- Fourth Start -->
							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font name</label>
									<select name="fo_body_id" class="form-control">
										<option value="">Default</option>
										<?php foreach ($google_fonts as $var) { ?>
										  <option value="<?php echo $var->id ?>" <?php if($var->id == $row->fo_body_id) { echo "selected='selected'"; } ?> ><?php echo $var->font_name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>                 

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font size on web</label>
									<select name="fo_w_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_w_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font size on mobile</label>
									<select name="fo_m_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_m_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font size on tablet</label>
									<select name="fo_t_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_t_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="">Fourth font color</label>
								<input type="text" class="form-control color" name="fo_color" value="<?php echo $row->fo_color; ?>">
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font weight</label>
									<select name="fo_weight" class="form-control">
										<option value="">Default</option>
										<option value="<?php echo $row->fo_weight ?>" selected="selected"><?php echo $row->fo_weight ?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font line height</label>
									<select name="fo_line_height" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_line_height) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font word spacing</label>
									<select name="fo_word_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_word_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fourth font letter spacing</label>
									<select name="fo_letter_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fo_letter_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<input type="hidden" id="fo_weight" value="<?php echo $row->fo_weight ?>">
							<script type="text/javascript">
								$(document).ready(function(){
							        $("select[name=fo_body_id]").trigger('change');
							    });

							    $('select[name=fo_body_id]').change(function(){
									var val = $(this).val();
									$.ajax({
										method:'POST',
										url:'<?php echo base_url() ?>fonts/get_font_weights/'+val ,
										success:function(res){          
											$('select[name=fo_weight]').html(res);
											if($("#fo_weight").val() != '0'){
												$('select[name=fo_weight]').val($("#fo_weight").val());
												$("#fo_weight").val(0);
											}
										}
									});        
								});
							</script>

							<!-- Fourth End -->

							<!-- Fifth Start -->
							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font name</label>
									<select name="fi_body_id" class="form-control">
										<option value="">Default</option>
										<?php foreach ($google_fonts as $var) { ?>
										  <option value="<?php echo $var->id ?>" <?php if($var->id == $row->fi_body_id) { echo "selected='selected'"; } ?> ><?php echo $var->font_name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>                 

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font size on web</label>
									<select name="fi_w_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_w_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font size on mobile</label>
									<select name="fi_m_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_m_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font size on tablet</label>
									<select name="fi_t_size" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_t_size) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="">Fifth font color</label>
								<input type="text" class="form-control color" name="fi_color" value="<?php echo $row->fi_color; ?>">
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font weight</label>
									<select name="fi_weight" class="form-control">
										<option value="">Default</option>
										<option value="<?php echo $row->fi_weight ?>" selected="selected"><?php echo $row->fi_weight ?></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font line height</label>
									<select name="fi_line_height" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_line_height) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font word spacing</label>
									<select name="fi_word_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_word_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="selectbox">
									<label for="">Fifth font letter spacing</label>
									<select name="fi_letter_spacing" class="form-control">
										<option value="">Default</option>
										<?php for($i=1;$i<=200;$i++) { ?>
											<option value="<?php echo $i ?>px" <?php if($i.'px' == $row->fi_letter_spacing) { echo "selected='selected'"; } ?> ><?php echo $i ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<input type="hidden" id="fi_weight" value="<?php echo $row->fi_weight ?>">
							<script type="text/javascript">
								$(document).ready(function(){
							        $("select[name=fi_body_id]").trigger('change');
							    });

							    $('select[name=fi_body_id]').change(function(){
									var val = $(this).val();
									$.ajax({
										method:'POST',
										url:'<?php echo base_url() ?>fonts/get_font_weights/'+val ,
										success:function(res){          
											$('select[name=fi_weight]').html(res);
											if($("#fi_weight").val() != '0'){
												$('select[name=fi_weight]').val($("#fi_weight").val());
												$("#fi_weight").val(0);
											}
										}
									});        
								});
							</script>

							<!-- Fifth End -->
							*/ ?>
							 
							<input type="submit" name="submit" class="btn btn-primary" value="Update">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>