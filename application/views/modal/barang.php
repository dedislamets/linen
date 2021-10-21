<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Linen</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name ="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
			
					<div class="form-group">
						<label>Serial</label>
						<input type="text" id="serial" name="serial" class="form-control" readonly />
					</div>	
					<div class="form-group">
				        <label>Jenis Barang</label>
				        <select id="id_jenis" name="id_jenis" class="form-control" >
				            <?php 
				            foreach($jenis as $row)
				            { 
				              echo '<option value="'.$row->id.'">'.$row->jenis.'</option>';
				            }?>
				            
				        </select>
				    </div>
									
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>