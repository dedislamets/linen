<div id="modal-personal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog mp" role="document">
    <div class="modal-content">
      <div class="modal-header table-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title ">Personal Information > <span id="action"></span></h4>
      </div>
      <div class="modal-body">
          <div class="col-sm-12">
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                    <a data-toggle="tab" href="#home">
                      <i class="green ace-icon fa fa-home bigger-120"></i>
                      Basic Data
                    </a>
                  </li>

                  <li>
                    <a data-toggle="tab" href="#messages">
                      Family & Tax
                    </a>
                  </li>

                  <li class="dropdown">
                    <a data-toggle="tab" href="#tab-address">
                      Address
                    </a>
                  </li>
                  <li class="dropdown">
                    <a data-toggle="tab" href="#education">
                      Education
                    </a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <form id="form-biodata" class="form-horizontal" role="form">
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Foto Profil</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>
                          <div class="widget-body">
                            <div class="widget-main">
                              <span id="uploaded_image"></span>
                              <div style="text-align: center;">
                                  <figure class="profile-img">
                                      <img id="profileimg" class="img-responsive" src="" alt="" style="width: 200px;margin-left: auto;margin-right: auto;">
                                  </figure>
                                  <div class="btn-group" style="margin-top: 10px;">
                                      <button type="button" class="btn btn-secondary btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Change foto profile                   
                                          <i class="fa fa-gear"></i> 
                                          <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li>
                                              <a class="btn-file js-upload-profile-pic">
                                                  <input name="file" id="file" type="file">
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Biodata</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Emp. ID * </label>

                                  <div class="col-sm-8">
                                    <input type="text" id="empid" name="empid" placeholder="" class="form-control" readonly />
                                    <input type="hidden" id="recnumid" name="recnumid" value="" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Finger. ID </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="finger" name="finger" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Name *</label>
                                  <div class="col-sm-8">
                                    <input type="text" id="empname" name="empname" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Place Of Birth * </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="empplace" name="empplace" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="dateBirth">Date Of Birth *</label>
                                  <div class="col-sm-8">
                                    <div class="input-group">
                                      <input class="form-control date-picker" id="dateBirth" name="dateBirth" type="text" data-date-format="dd-mm-yyyy" />
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Age </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="age" placeholder="" class="form-control" readonly />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Nationality </label>
                                  <div class="col-sm-8">
                                    <select class="chosen-select form-control" id="country" name="country">
                                      <?php 
                                      foreach($country as $row_country)
                                      { 
                                        echo '<option value="'.$row_country->Recnum.'">'.$row_country->IsDesc.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="join">Join *</label>
                                  <div class="col-sm-8">
                                    <div class="input-group">
                                      <input class="form-control date-picker" id="join" name="join" type="text" data-date-format="dd-mm-yyyy" />
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Gender </label>
                                  <div class="col-sm-8">
                                    <select class="chosen-select form-control" id="gender" name="gender">
                                      <?php 
                                      foreach($gender as $row_gender)
                                      { 
                                        echo '<option value="'.$row_gender->Recnum.'">'.$row_gender->IsDesc.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="married">Married Date </label>
                                  <div class="col-sm-8">
                                    <div class="input-group">
                                      <input class="form-control date-picker" id="married" name="married" type="text" data-date-format="dd-mm-yyyy" />
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="religion">Religion *</label>
                                  <div class="col-sm-8">
                                    <select class="chosen-select form-control" id="religion" name="religion">
                                      <?php 
                                      foreach($agama as $row_agama)
                                      { 
                                        echo '<option value="'.$row_agama->Recnum.'">'.$row_agama->IsDesc.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="blood">Blood *</label>
                                  <div class="col-sm-3">
                                    <select class="chosen-select form-control" id="blood" name="blood">
                                      <?php 
                                      foreach($darah as $row_darah)
                                      { 
                                        echo '<option value="'.$row_darah->Recnum.'">'.$row_darah->IsDesc.'</option>';
                                      }?>
                                    </select>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                      <label class="col-sm-6 control-label no-padding-right" for="Official">Use Lens</label>
                                      <div class="col-sm-1" style="padding-top: 9px;">
                                        <label>
                                          <input id="isLens" name="isLens" class="ace ace-switch" type="checkbox" checked />
                                          <span class="lbl"></span>
                                        </label>
                                      </div>
                                    
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="height"> Height </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="height" name="height" placeholder="CM" class="form-control number" />
                                  </div>
                                  <label class="col-sm-2 control-label no-padding-right" for="weight"> Weight </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="weight" name="weight" placeholder="KG" class="form-control number" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Alias </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="alias" name="alias" placeholder="Alias" class="form-control" />
                                  </div>
                                </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Uniform Size</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="shirt">Shirt </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="shirt" name="shirt" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-3 control-label no-padding-right" for="shirt_short">Shirt Short </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="shirt_short" name="shirt_short" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="pants">Pants </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="pants" name="pants" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-3 control-label no-padding-right" for="shoes">Shoes </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="shoes" name="shoes" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="helmet">Helmet </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="helmet" name="helmet" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-3 control-label no-padding-right" for="shoes_office">Shoes Office </label>
                                  <div class="col-sm-3">
                                    <input type="text" id="shoes_office" name="shoes_office" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="hat">Hat </label>
                                  <div class="col-sm-9">
                                    <input type="text" id="hat" name="hat" placeholder="" class="form-control" />
                                  </div>
                                  
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Information Card</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Family Card * </label>

                                  <div class="col-sm-9">
                                    <input type="text" id="kk" name="kk" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> KTP *</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="ktp" name="ktp" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Passport No.</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="passport" name="passport" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="passport_exp">Passport Exp </label>
                                  <div class="col-sm-9">
                                    <div class="input-group">
                                      <input class="form-control date-picker" id="passport_exp" name="passport_exp" type="text" data-date-format="dd-mm-yyyy" />
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> NPWP No.</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="npwp" name="npwp" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="npwp_exp">NPWP Exp </label>
                                  <div class="col-sm-9">
                                    <div class="input-group">
                                      <input class="form-control date-picker" id="npwp_exp" name="npwp_exp" type="text" data-date-format="dd-mm-yyyy" />
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Office</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="office_mail"> Office Mail * </label>

                                  <div class="col-sm-9">
                                    <input type="email" id="office_mail" name="office_mail" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="personal_mail"> Personal Mail * </label>
                                  <div class="col-sm-9">
                                    <input type="email" id="personal_mail" name="personal_mail" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="phone"> Phone</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="phone" name="phone" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="ext"> Ext. No</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="ext" name="ext" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <!-- <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="build"> Build</label>
                                  <div class="col-sm-3">
                                    <input type="text" id="build" name="build" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-3 control-label no-padding-right" for="room"> Room</label>
                                  <div class="col-sm-3">
                                    <input type="text" id="room" name="room" placeholder="" class="form-control" />
                                  </div>
                                </div> -->
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="comp_name"> Computer Name</label>
                                  <div class="col-sm-3">
                                    <input type="text" id="comp_name" name="comp_name" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-3 control-label no-padding-right" for="ip"> IP Address</label>
                                  <div class="col-sm-3">
                                    <input type="text" id="ip" name="ip" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="poh"> Home Base / POH</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="poh" name="poh" placeholder="" class="form-control number" />
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="float: right;margin-right: 0px;margin-top: 10px;">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="return savebiodata()" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>

                     
                    </form>
                  </div>

                  <div id="messages" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Family Detail </h4>
                          <div class="widget-toolbar">
                            <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddDetail"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                         
                          <div class="table-responsive">
                            <table id="tabel-family" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>NIK</th>
                                  <th>Name</th>
                                  <th>Relation</th>
                                  <th>Birth Date</th> 
                                  <th>Age</th>
                                  <th>Gender</th>             
                                </tr>
                              </thead>
                              <tbody>    
                                                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 no-padding">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Family Status </h4>
                          <div class="widget-toolbar">
                            <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddStatus"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-status" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
                              <thead>
                                <tr>
          
                                  <th>Status</th>
                                  <th>Start</th>
                                  <th>End Date</th>               
                                </tr>
                              </thead>
                              <tbody>    

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 no-padding">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Marital Status </h4>
                          <div class="widget-toolbar">
                           <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddMarital"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-marital" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
                              <thead>
                                <tr>
                      
                                  <th>Status</th>
                                  <th>Start</th>
                                  <th>End Date</th>               
                                </tr>
                              </thead>
                              <tbody>    
                                                   
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 no-padding">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Tax Method </h4>
                          <div class="widget-toolbar">
                           <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddTax"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-tax" class="table table-striped table-bordered table-hover" style="margin-bottom: 0">
                              <thead>
                                <tr>
                                  <th>Status</th>
                                  <th>Start Date</th>          
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

                  <div id="tab-address" class="tab-pane fade">
                    <form  id="form-address" class="form-horizontal" role="form">
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Permanent Address</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="address"> Alamat </label>

                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="address" name="address" placeholder="" rows="4" maxlength="300"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="rt"> RT</label>
                                  <div class="col-sm-1" style="padding-right: 0;width: 53px;">
                                    <input type="text" id="rt" name="rt" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-1 control-label no-padding-right" for="rw"> RW</label>
                                  <div class="col-sm-1" style="padding-right: 0;width: 53px;">
                                    <input type="text" id="rw" name="rw" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-2 control-label no-padding-right" for="pos" style="padding-left: 0"> Post Code</label>
                                  <div class="col-sm-3" >
                                    <input type="text" id="pos" name="pos" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="country">Country </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="countryAddress" name="countryAddress">
                                      <option value="0">- Choose -</option>
                                      <?php 
                                        foreach($country as $row_country)
                                        { 
                                          echo '<option value="'.$row_country->Recnum.'">'.$row_country->IsDesc.'</option>';
                                        }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="prov">Province </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="prov" name="prov" >
                                       <option value="0">- Choose -</option>
                                      <?php 
                                        foreach($prov as $row_prov)
                                        { 
                                          echo '<option value="'.$row_prov->Recnum.'">'.$row_prov->IsDesc.'</option>';
                                        }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="city">City </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="city" name="city" >
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="state">State </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="state" name="state">
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="kel">Kelurahan </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="kel" name="kel">
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="pool_bus">Pool Bus</label>
                                  <div class="col-sm-9">
                                    <div class="input-group">
                                      <input class="form-control" id="pool_bus" name="pool_bus" type="text" maxlength="5" readonly />
                                      <span class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div> -->
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone</label>
                                  <div class="col-sm-2">
                                    <input type="text" id="phone1" name="phone1" placeholder="" class="form-control" />
                                  </div>
                                  <div class="col-sm-7">
                                    <input type="text" id="phone2" name="phone2" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Handphone</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="hp" name="hp" placeholder="" class="form-control" />
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Emergency Contact 1</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main"> 
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="name_emergency_1" name="name_emergency_1" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Relation</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="relation_emergency_1" name="relation_emergency_1" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="phone2_emergency_1" name="phone2_emergency_1" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="address"> Alamat </label>

                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="address_emergency_1" name="address_emergency_1" placeholder="" rows="4" maxlength="300"></textarea>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Current Address</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="address"> Alamat </label>

                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="address_current" name="address_current" placeholder="" rows="4" maxlength="300"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="rt"> RT</label>
                                  <div class="col-sm-1" style="padding-right: 0;width: 53px;">
                                    <input type="text" id="rt_current" name="rt_current" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-1 control-label no-padding-right" for="rw"> RW</label>
                                  <div class="col-sm-1" style="padding-right: 0;width: 53px;">
                                    <input type="text" id="rw_current" name="rw_current" placeholder="" class="form-control" />
                                  </div>
                                  <label class="col-sm-2 control-label no-padding-right" for="pos" style="padding-left: 0"> Post Code</label>
                                  <div class="col-sm-3" >
                                    <input type="text" id="pos_current" name="pos_current" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="country">Country </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="ccountryAddress" name="ccountryAddress">
                                      <option value="0">- Choose -</option>
                                      <?php 
                                        foreach($country as $row_country)
                                        { 
                                          echo '<option value="'.$row_country->Recnum.'">'.$row_country->IsDesc.'</option>';
                                        }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="prov">Province </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="cprov" name="cprov" >
                                       <option value="0">- Choose -</option>
                                      <?php 
                                        foreach($prov as $row_prov)
                                        { 
                                          echo '<option value="'.$row_prov->Recnum.'">'.$row_prov->IsDesc.'</option>';
                                        }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="city">City </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="ccity" name="ccity" >
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="state">State </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="cstate" name="cstate">
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="kel">Kelurahan </label>
                                  <div class="col-sm-9">
                                    <select class="chosen-select form-control" id="ckel" name="ckel">
                                      <option value="0">- Choose -</option>
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone</label>
                                  <div class="col-sm-2">
                                    <input type="text" id="phone1_current" name="phone1_current" placeholder="" class="form-control" />
                                  </div>
                                  <div class="col-sm-7">
                                    <input type="text" id="phone2_current" name="phone2_current" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Handphone</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="hp_current" name="hp_current" placeholder="" class="form-control" />
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-box">
                          <div class="widget-header">
                            <h4 class="widget-title">Emergency Contact 2</h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                              </a>

                              <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="name_emergency_2" name="name_emergency_2" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Relation</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="relation_emergency_2" name="relation_emergency_2" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone</label>
                                  <div class="col-sm-9">
                                    <input type="text" id="phone2_emergency_2" name="phone2_emergency_2" placeholder="" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right" for="address"> Alamat </label>

                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="address_emergency_2" name="address_emergency_2" placeholder="" rows="4" maxlength="300"></textarea>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="float: right;margin-right: 0px;margin-top: 10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="return saveaddress()" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                  </div>
                  <div id="education" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Education</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddEdu"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-education" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Institution Name</th>
                                  <th>Majoring</th>
                                  <th>From</th> 
                                  <th>To</th>
                                  <th>Level</th>                
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Certificate Training</h4>
                          <div class="widget-toolbar">
                            <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddTraining"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-training" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Certificate</th>
                                  <th>Certificate No</th>
                                  <th>Published Date</th> 
                                  <th>Graduates</th>             
                                </tr>
                              </thead>
                              <tbody>    
                                                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>