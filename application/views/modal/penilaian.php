<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content" >
	      	<div class="modal-header">
	        	
	        	<h4 class="modal-title" id="myModalLabel" ><label> Pilih Tanggal</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="mg-b-20">
					            <div class="input-group">
					              <div class="input-group-prepend">
					                <div class="input-group-text">
					                  <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
					                </div>
					              </div>
					              <input type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
					            </div>
					        </div>
							
						</div>
						
					</div>
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
			</form>
		</div>
	</div>
</div>