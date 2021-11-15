<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="dialog" style="margin: 10% auto;max-width: 900px;">
	    <div class="modal-content" id="app">
	      	<div class="modal-header" style="background-color: green;color:#fff">
	        	
	        	<h4 class="modal-title" id="myModalLabel" style="color: #fff"><label id="lbl-title"></label> <label> Users</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" class="grab form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Nama User<span style="color:red"> *</span></label>
								<input type="text" id="nama_user" name="nama_user" class="form-control" maxlength="200" />
							</div>

							<div class="form-group">
								<label>Email<span style="color:red"> *</span></label>
								<input type="email" id="email" name="email" class="form-control" maxlength="200" />
							</div>	
							<div class="form-group">
								<label>Password</label>
								<input type="password" id="password" name="password" class="form-control" />
							</div>	
							<div class="form-group">
								<label>Bagian<span style="color:red"> *</span></label>
								<select name="department" id="department" class="form-control">
			                      <?php 
			                      foreach($group as $row)
			                      { 
			                      	echo '<option value="'.$row->group.'">'.$row->group.'</option>';
			                      }
			                      ?>
			                    </select>
							</div>	
							
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
									<option value="Pria">Pria</option>
									<option value="Wanita">Wanita</option>
			                    </select>
							</div>	
							<div class="form-group">
								<label>Aktif</label><br>
								<input type="checkbox" id="status" name="status" />
							</div>
							<div class="form-group">
								<label>Punya Bawahan ?</label><br>
								<input type="checkbox" id="ada_bawahan" name="ada_bawahan" />
							</div>

							<div class="col-lg-12" id="data-bawahan" style="display: none;">
                                <div class="p-20 z-depth-0 waves-effect" > 
                                    <div class="card-header" style="background-color: #404E67;color:#fff">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h4>Bawahan</h4>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="javascrip:void(0)" class="btn btn-success btn-block" id="btnAddUser"  data-toggle="modal" data-target="#ModalUser"><i class="icofont icofont-ui-add"></i> Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dt-responsive table-responsive">
                                        <table id="ViewTableUser" class="table table-striped" style="width: 100%">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th>
                                                      User Name
                                                    </th>
                                                    <th>
                                                      Email
                                                    </th>
                                                    
                                                    <th class="text-left">
                                                      Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
						</div>
						
					</div>
					<input type="hidden" name="id" id="id" value="">
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

<div id="ModalUser" class="modal" >
  <div class="modal-dialog" role="dialog" style="margin: 10% auto;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #404E67;color:#fff">
            <h4 class="modal-title" id="myModalLabel" style="color:#fff"><label >Pilih User</label> <label id="lbl-title-cust"></label></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body" >
          <div class="dt-responsive table-responsive">
            <table id="ModalTableUser" class="table table-striped" style="width: 100%">
                <thead class="text-primary">
                    <tr>
                      <th>Pilih</th>
                      <th>Username</th>
                      <th>Nama User</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
          </div>
          <div style="display: none">
              <input type="text" id="txtSelected" name="txtSelected">
          </div>
        </div>
        <div class="modal-footer" >
            <button type="button" class="btn btn-success" id="btnpilih">Submit</button>
        </div>
      </div>
  </div>
</div>