<style type="text/css">
 /* #modal-personal {
    opacity: 1.5!important;
  }
  */

</style>
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

                  <li id="liFamily">
                    <a data-toggle="tab" href="#messages">
                      Family & Tax
                    </a>
                  </li>

                  <li class="dropdown" id="liAddress">
                    <a data-toggle="tab" href="#tab-address">
                      Address
                    </a>
                  </li>
                  <li class="dropdown" id="liEducation">
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
                                  
                                    <select class="chosen-select form-control" id="empplace" name="empplace">
                                      <?php 
                                      foreach($city as $row_city)
                                      { 
                                        echo '<option value="'.$row_city->Recnum.'">'.$row_city->IsDesc.'</option>';
                                      }?>
                                    </select>
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

<div class="sub-modal-personal">
  <div id="modal-family-detail" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Family Input </span></h4>
        </div>
        <form id="form-input-family" class="form-horizontal" role="form">
          <div class="modal-body">
              
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name * </label>

                    <div class="col-sm-9">
                      <input type="text" id="fa_name" name="fa_name" placeholder="" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> NIK *</label>
                    <div class="col-sm-9">
                      <input type="text" id="fa_nik" name="fa_nik" placeholder="" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Relation </label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="fa_relasi" name="fa_relasi">
                        <?php 
                        foreach($family_relation as $row_relasi)
                        { 
                          echo '<option value="'.$row_relasi->Recnum.'">'.$row_relasi->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Place Birth</label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="fa_place" name="fa_place">
                          <?php 
                          foreach($city as $row_city)
                          { 
                            echo '<option value="'.$row_city->Recnum.'">'.$row_city->IsDesc.'</option>';
                          }?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="passport_exp">Birth Date *</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input class="form-control date-picker" id="fa_birth_date" name="fa_birth_date" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Gender </label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="fa_gender" name="fa_gender">
                        <?php 
                        foreach($gender as $row_gender)
                        { 
                          echo '<option value="'.$row_gender->Recnum.'">'.$row_gender->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="Official">Married</label>
                    <div class="col-sm-9">
                      <label>
                        <input id="isMarried" name="isMarried" class="ace ace-switch" type="checkbox" />
                        <span class="lbl"></span>
                      </label>
                    </div>
                  
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="blood">Blood *</label>
                      <div class="col-sm-9">
                        <select class="chosen-select form-control" id="fa_blood" name="fa_blood">
                          <option value="0">-- Choose --</option>
                          <?php 
                          foreach($darah as $row_darah)
                          { 
                            echo '<option value="'.$row_darah->Recnum.'">'.$row_darah->IsDesc.'</option>';
                          }?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="religion">Job</label>
                    <div class="col-sm-9">
                        <input type="text" id="fa_job" name="fa_job" placeholder="" class="form-control" />
                    </div>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveFamily">Save</button>
            <input type="hidden" name="RecnumFamily" id="RecnumFamily" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-family-status" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Status Family Input </span></h4>
        </div>
        <form id="form-input-status" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Status</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="fa_status" name="fa_status">
                      <?php 
                      foreach($family_status as $row_status)
                      { 
                        echo '<option value="'.$row_status->Recnum.'">'.$row_status->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Start Date *</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_stat" name="dateRangeStart_stat" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <label class="col-sm-1 control-label ">To</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeEnd_stat" name="dateRangeEnd_stat" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="religion">Prorate Medical</label>
                <div class="col-sm-3 no-padding-right">
                    <input type="number" id="fa_prorate" name="fa_prorate" placeholder="" class="form-control" value="0" />
                </div>
                <div class="col-sm-3 no-padding-right">
                  <button class="btn btn-sm btn-warning">
                    <i class="ace-icon fa fa-calculator bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Calculate</span>
                  </button>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveFamilyStatus">Save</button>
            <input type="hidden" name="RecnumFamilyStatus" id="RecnumFamilyStatus" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-family-marital" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Marital Family Input </span></h4>
        </div>
        <form id="form-input-marital" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Status</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="fa_marital" name="fa_marital">
                      <?php 
                      foreach($family_marital as $row_marital)
                      { 
                        echo '<option value="'.$row_marital->Recnum.'">'.$row_marital->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Start Date *</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_marital" name="dateRangeStart_marital" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <label class="col-sm-1 control-label ">To</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeEnd_marital" name="dateRangeEnd_marital" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveFamilyMarital">Save</button>
            <input type="hidden" name="RecnumFamilyMarital" id="RecnumFamilyMarital" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-family-tax" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Tax Method Input </span></h4>
        </div>
        <form id="form-input-tax" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Tax</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="fa_tax" name="fa_tax">
                      <?php 
                      foreach($family_tax as $row_tax)
                      { 
                        echo '<option value="'.$row_tax->Recnum.'">'.$row_tax->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Start Date *</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_tax" name="dateRangeStart_tax" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveTax">Save</button>
            <input type="hidden" name="RecnumTax" id="RecnumTax" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-education" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Education Input </span></h4>
        </div>
        <form id="form-input-education" class="form-horizontal" role="form">
          <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Level </label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="edu_level" name="edu_level">
                        <?php 
                        foreach($education as $row_edu)
                        { 
                          echo '<option value="'.$row_edu->Recnum.'">'.$row_edu->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> School Name *</label>
                    <div class="col-sm-9">
                      <input type="text" id="edu_school" name="edu_school" placeholder="" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Majoring</label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="edu_major" name="edu_major">
                        <option value="0">-- Blank --</option>
                          <?php 
                          foreach($major as $row_major)
                        { 
                          echo '<option value="'.$row_major->Recnum.'">'.$row_major->IsDesc.'</option>';
                        }?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="Sort">Since </label>
                    <div class="col-sm-4 no-padding-right">
                      <div class="input-group">
                        <input class="form-control date-picker" id="dateRangeStart_edu" name="dateRangeStart_edu" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                    <label class="col-sm-1 control-label ">To</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <input class="form-control date-picker" id="dateRangeEnd_edu" name="dateRangeEnd_edu" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="gpa">GPA</label>
                      <div class="col-sm-9">
                         <input type="text" id="edu_gpa" name="edu_gpa" placeholder="" class="form-control" />
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="religion">Certificate No</label>
                    <div class="col-sm-9">
                        <input type="text" id="edu_certificate" name="edu_certificate" placeholder="" class="form-control" />
                    </div>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveEducation">Save</button>
            <input type="hidden" name="RecnumEducation" id="RecnumEducation" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-training" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Training Input </span></h4>
        </div>
        <form id="form-input-training" class="form-horizontal" role="form">
          <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Materi </label>
                    <div class="col-sm-9">
                      <select class="chosen-select form-control" id="training" name="training">
                        <?php 
                        foreach($training as $row_training)
                        { 
                          echo '<option value="'.$row_training->Recnum.'">'.$row_training->IsDesc.'</option>';
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="Official">License</label>
                    <div class="col-sm-9">
                      <label>
                        <input id="isLicense" name="isLicense" class="ace ace-switch" type="checkbox" />
                        <span class="lbl"></span>
                      </label>
                    </div>
                  
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Certificate No *</label>
                    <div class="col-sm-9">
                      <input type="text" id="tra_certificate" name="tra_certificate" placeholder="" class="form-control" />
                    </div>
                  </div>
          
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="Sort">Since </label>
                    <div class="col-sm-4 no-padding-right">
                      <div class="input-group">
                        <input class="form-control date-picker" id="dateRangeStart_tra" name="dateRangeStart_tra" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                    <label class="col-sm-1 control-label ">To</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <input class="form-control date-picker" id="dateRangeEnd_tra" name="dateRangeEnd_tra" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="gpa">Trainer Name</label>
                      <div class="col-sm-9">
                         <input type="text" id="tra_trainer" name="tra_trainer" placeholder="" class="form-control" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="gpa">Score</label>
                      <div class="col-sm-9">
                         <input type="text" id="tra_score" name="tra_score" placeholder="" class="form-control" />
                      </div>
                  </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveTraining">Save</button>
            <input type="hidden" name="RecnumTraining" id="RecnumTraining" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal-employee-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header table-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title ">Employee Data > <span id="action-data"></span></h4>
      </div>
      <div class="modal-body">
          <div class="col-sm-12">
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                    <a data-toggle="tab" href="#reward">
                      Reward & Pusnishment
                    </a>
                  </li>

                  <li>
                    <a data-toggle="tab" href="#inventory">
                      Inventory
                    </a>
                  </li>

                  <li class="dropdown">
                    <a data-toggle="tab" href="#history">
                      Job History
                    </a>
                  </li>
                  <li class="dropdown">
                    <a data-toggle="tab" href="#salary">
                      History Salary
                    </a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div id="reward" class="tab-pane fade in active">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Reward</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddReward"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-reward" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Reward</th>
                                  <th>Date</th>
                                  <th>Allowance</th>          
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
                          <h4 class="widget-title">Punishment</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddPunish"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-punish" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Punishment</th>
                                  <th>Date</th>
                                  <th>Deduction</th>          
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div id="inventory" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Inventory</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddInventory"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-inventory" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Item</th>
                                  <th>Qty</th>
                                  <!-- <th>Receive Date</th>  -->
                                  <th>Expired Date</th> 
                                  <th>Status</th> 
                                  <th>Return Date</th>          
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div id="history" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Grade</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddGrade"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-grade" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Class</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>SK No.</th>
                                  <th>Remark</th>          
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
                          <h4 class="widget-title">Organization</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddOrg"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-organization" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Organization</th>
                                  <th>Position Structural</th>
                                  <th>Position Functional</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>SK No.</th>
                                  <th>Remark</th>          
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
                          <h4 class="widget-title">Employment Status</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddEmpStatus"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-employee-status" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Status</th>
                                  <th>Alert</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>SK No.</th>
                                  <th>Remark</th>          
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div id="salary" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Salary</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddSalary"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-salary" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Component</th>
                                  <th>Value</th>
                                  
                                  <th>Start Date</th>
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
<div id="modal-additional" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog mp" role="document">
    <div class="modal-content">
      <div class="modal-header table-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title ">Additional Info > <span id="action-data"></span></h4>
      </div>
      <div class="modal-body">
          <div class="col-sm-12">
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                    <a data-toggle="tab" href="#experience">
                      Experience
                    </a>
                  </li>

                  <li>
                    <a data-toggle="tab" href="#vehicle">
                      Vehicle & SIM
                    </a>
                  </li>

                  <li class="dropdown">
                    <a data-toggle="tab" href="#membership">
                      Membership
                    </a>
                  </li>
                  <li class="dropdown">
                    <a data-toggle="tab" href="#resign">
                      Employee Resign
                    </a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div id="experience" class="tab-pane fade in active">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Experience</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddExperience"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-experience" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Company</th>
                                  <th>Position</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Remark</th>          
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div id="vehicle" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Vehicle</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddVehicle"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-vehicle" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Police No</th>
                                  <th>Frame No</th>
                                  <th>Machine No</th> 
                                  <th>Start Date</th> 
                                  <th>Remark</th>          
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
                          <h4 class="widget-title">SIM</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddSIM"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-sim" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>SIM</th>
                                  <th>SIM No</th>
                                  <th>Start Date</th>
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

                  <div id="membership" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Membership</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddMembership"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-membership" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Membership Type</th>
                                  <th>Membership No</th>
                                  <th>Value From Employee</th>
                                  <th>Percent From Employee</th>
                                  <th>Value From Company</th>
                                  <th>Percent From Company</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Maximum Salary</th>
                                  <th>Remark</th>          
                                </tr>
                              </thead>
                              <tbody>    
                                                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
            
                  </div>
                  <div id="resign" class="tab-pane fade">
                    <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">Salary</h4>
                          <div class="widget-toolbar">
                             <button class="btn btn-sm btn-white btn-success btn-round" id="btnAddSalary"><i class="ace-icon fa fa-plus red2"></i></button>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table id="tabel-resign" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Component</th>
                                  <th>Value</th>
                                  
                                  <th>Start Date</th>
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

<div class="sub-modal-emplyee-data">
  <div id="modal-reward" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Reward Input </span></h4>
        </div>
        <form id="form-input-reward" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">By</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="reward_by" name="reward_by">
                      <?php 
                      foreach($emp as $row_emp)
                      { 
                        echo '<option value="'.$row_emp->Recnum.'">'.$row_emp->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Start Date</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_reward" name="dateRangeStart_reward" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="address"> Description *</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="reward_desc" name="reward_desc" placeholder="" rows="3" maxlength="300"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Allowance *</label>
                <div class="col-sm-9">
                  <input type="number" id="allowance" name="allowance" placeholder="" value="0" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Allowance Date</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="allowance_date" name="allowance_date" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveReward">Save</button>
            <input type="hidden" name="RecnumReward" id="RecnumReward" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-punishment" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Punishment Input </span></h4>
        </div>
        <form id="form-input-punish" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Type</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="punish_type" name="punish_type">
                      <?php 
                      foreach($punishment as $row_punish)
                      { 
                        echo '<option value="'.$row_punish->Recnum.'">'.$row_punish->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Date </label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_punish" name="dateRangeStart_punish" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <label class="col-sm-1 control-label ">To</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeEnd_punish" name="dateRangeEnd_punish" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">By</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="punish_by" name="punish_by">
                      <?php 
                      foreach($emp as $row_emp)
                      { 
                        echo '<option value="'.$row_emp->Recnum.'">'.$row_emp->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Deduction</label>
                <div class="col-sm-9">
                  <input type="number" id="deduction" name="deduction" placeholder="" value="0" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Deduction Date</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="deduction_date" name="deduction_date" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="address"> Description</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="punish_desc" name="punish_desc" placeholder="" rows="3" maxlength="300"></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSavePunish">Save</button>
            <input type="hidden" name="RecnumPunish" id="RecnumPunish" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-inventaris" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ">Inventaris Input </span></h4>
        </div>
        <form id="form-input-inventaris" class="form-horizontal" role="form">
          <div class="modal-body">
              
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Item</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="item" name="item">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($inventaris as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Expired Date</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="expired_date" name="expired_date" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Quantity</label>
                <div class="col-sm-9">
                  <input type="number" id="qty" name="qty" placeholder="" value="0" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="Sort">Return</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="return_date" name="return_date" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="blood">Status</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="item_status" name="item_status">
                      <?php 
                      foreach($inventaris_status as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveInventaris">Save</button>
            <input type="hidden" name="RecnumInventaris" id="RecnumInventaris" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-grade" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>Grade Input </span></h4>
        </div>
        <form id="form-input-grade" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">Class</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="grade_class" name="grade_class">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($class as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_grade" name="dateRangeStart_grade" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_grade" name="dateRangeEnd_grade" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> SK No.</label>
              <div class="col-sm-9">
                <input type="text" id="SKNo" name="SKNo" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">SK Date</label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="SK_Date" name="SK_Date" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="grade_remark" name="grade_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveGrade">Save</button>
            <input type="hidden" name="RecnumGrade" id="RecnumGrade" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-emp-status" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span>Employement Status Input </span></h4>
        </div>
        <form id="form-input-emp-status" class="form-horizontal" role="form">
          <div class="modal-body">
              
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">Working Status</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="work_status" name="work_status">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($working_status as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                    }?>
                  </select>
                </div>
            </div>
 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_status" name="dateRangeStart_status" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_status" name="dateRangeEnd_status" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> SK No.</label>
              <div class="col-sm-9">
                <input type="text" id="SKNo2" name="SKNo2" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">End Date Contract Alert</label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="SK_alert" name="SK_alert" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="status_remark" name="status_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveStatus">Save</button>
            <input type="hidden" name="RecnumStatus" id="RecnumStatus" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-emp-org" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 900px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span>Employement Organization Input </span></h4>
        </div>
        <form id="form-input-emp-org" class="form-horizontal" role="form">
          <div class="modal-body">
            <div class="col-md-6">
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Section *</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="orgz" name="orgz">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($organization as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->OrgName.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Position Structure</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="structural" name="structural">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($structural as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->PositionName.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Position Functional</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="fungsional" name="fungsional">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($fungsional as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->PositionName.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="Sort">Start </label>
                <div class="col-sm-3 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeStart_org" name="dateRangeStart_org" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <label class="col-sm-1 control-label ">To</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input class="form-control date-picker" id="dateRangeEnd_org" name="dateRangeEnd_org" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> SK No.</label>
                <div class="col-sm-8">
                  <input type="text" id="SKNo3" name="SKNo3" placeholder="" value="" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="Sort">SK Date</label>
                <div class="col-sm-4 no-padding-right">
                  <div class="input-group">
                    <input class="form-control date-picker" id="SK_Date_Org" name="SK_Date_Org" type="text" data-date-format="dd-mm-yyyy" />
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Type *</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="tipemove" name="tipemove">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($tipemove as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="address"> Remark </label>

                <div class="col-sm-8">
                  <textarea class="form-control" id="org_remark" name="org_remark" placeholder="" rows="3" maxlength="300"></textarea>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="blood">KPP</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="kpp" name="kpp">
                        <option value="0">-- Choose --</option>
                        <?php 
                        foreach($kpp as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                        }?>
                      </select>
                    </div>
              </div>
            </div>
            <div class="col-md-6" style="border: 1px solid gray;border-radius: 5px;padding: 5px;">
              <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="blood">Secondary Section</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="ss" name="ss">
                        <option value="0">-- Choose --</option>
                        <?php 
                        foreach($organization as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->OrgName.'</option>';
                        }?>
                      </select>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="blood">Secondary Structural</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="sp" name="sp">
                        <option value="0">-- Choose --</option>
                        <?php 
                        foreach($structural as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->PositionName.'</option>';
                        }?>
                      </select>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="blood">Secondary Fungsional</label>
                    <div class="col-sm-8">
                      <select class="chosen-select form-control" id="sf" name="sf">
                        <option value="0">-- Choose --</option>
                        <?php 
                        foreach($fungsional as $row)
                        { 
                          echo '<option value="'.$row->Recnum.'">'.$row->PositionName.'</option>';
                        }?>
                      </select>
                    </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Head 1 *</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="head1" name="head1">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($emp as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">HR / HE</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="hr" name="hr">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($emp as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <!-- <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Admin Dept</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="admin_dept" name="admin_dept">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($emp as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
               -->
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Mentor</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="mentor" name="mentor">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($emp as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Secretary</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="secretary" name="secretary">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($emp as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">Location *</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="location" name="location">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($location as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->LocationName.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right" for="blood">COA</label>
                  <div class="col-sm-8">
                    <select class="chosen-select form-control" id="coa" name="coa">
                      <option value="0">-- Choose --</option>
                      <?php 
                      foreach($coa as $row)
                      { 
                        echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                      }?>
                    </select>
                  </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveOrg">Save</button>
            <input type="hidden" name="RecnumOrg" id="RecnumOrg" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-salary" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>Salary Input </span></h4>
        </div>
        <form id="form-input-salary" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">Component</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="component" name="component">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($component as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_salary" name="dateRangeStart_salary" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_salary" name="dateRangeEnd_salary" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Amount</label>
                <div class="col-sm-9">
                  <input type="number" id="salary_value" name="salary_value" placeholder="" value="0" class="form-control" />
                </div>
              </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> SK No.</label>
              <div class="col-sm-9">
                <input type="text" id="SKNo4" name="SKNo4" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">SK Date</label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="SK_Date_Salary" name="SK_Date_Salary" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="salary_remark" name="salary_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveSalary">Save</button>
            <input type="hidden" name="RecnumSalary" id="RecnumSalary" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="sub-modal-additional">
  <div id="modal-experience" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>Experience Input </span></h4>
        </div>
        <form id="form-input-experience" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Company *</label>
              <div class="col-sm-9">
                <input type="text" id="company" name="company" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_experience" name="dateRangeStart_experience" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_experience" name="dateRangeEnd_experience" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Netto</label>
              <div class="col-sm-9">
                <input type="number" id="netto" name="netto" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> PPH</label>
              <div class="col-sm-9">
                <input type="number" id="pph" name="pph" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Position</label>
              <div class="col-sm-9">
                <input type="text" id="experience_position" name="experience_position" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="experience_remark" name="experience_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveExperience">Save</button>
            <input type="hidden" name="RecnumExperience" id="RecnumExperience" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-vehicle" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>Salary Input </span></h4>
        </div>
        <form id="form-input-vehicle" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">Vehicle Code</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="vehicle_code" name="vehicle_code">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($vehicle as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Police No. *</label>
              <div class="col-sm-9">
                <input type="text" id="police_no" name="police_no" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Frame No.</label>
              <div class="col-sm-9">
                <input type="text" id="frame_no" name="frame_no" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Machine No.</label>
              <div class="col-sm-9">
                <input type="text" id="machine_no" name="machine_no" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_vehicle" name="dateRangeStart_vehicle" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_vehicle" name="dateRangeEnd_vehicle" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="vehicle_remark" name="vehicle_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveVehicle">Save</button>
            <input type="hidden" name="RecnumVehicle" id="RecnumVehicle" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-sim" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>SIM Input </span></h4>
        </div>
        <form id="form-input-sim" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">SIM Code</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="sim_code" name="sim_code">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($SIM as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsName.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> SIM No. *</label>
              <div class="col-sm-9">
                <input type="text" id="sim_no" name="sim_no" placeholder="" value="" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_sim" name="dateRangeStart_sim" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_sim" name="dateRangeEnd_sim" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="sim_remark" name="sim_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveSIM">Save</button>
            <input type="hidden" name="RecnumSIM" id="RecnumSIM" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-membership" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="width: 500px;">
      <div class="modal-content">
        <div class="modal-header table-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span>SIM Input </span></h4>
        </div>
        <form id="form-input-membership" class="form-horizontal" role="form">
          <div class="modal-body"> 
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="blood">Membership Type *</label>
                <div class="col-sm-9">
                  <select class="chosen-select form-control" id="membership_type" name="membership_type">
                    <option value="0">-- Choose --</option>
                    <?php 
                    foreach($membership as $row)
                    { 
                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
                    }?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Membership No. *</label>
              <div class="col-sm-9">
                <input type="text" id="membership_no" name="membership_no" placeholder="" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Value From Employee</label>
              <div class="col-sm-9">
                <input type="number" id="value_from_employee" name="value_from_employee" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Percent From Employee</label>
              <div class="col-sm-9">
                <input type="number" id="percent_from_employee" name="percent_from_employee" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Value From Company</label>
              <div class="col-sm-9">
                <input type="number" id="value_from_company" name="value_from_company" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Percent From Company</label>
              <div class="col-sm-9">
                <input type="number" id="percent_from_company" name="percent_from_company" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="Sort">Start </label>
              <div class="col-sm-4 no-padding-right">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeStart_membership" name="dateRangeStart_membership" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
              <label class="col-sm-1 control-label ">To</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <input class="form-control date-picker" id="dateRangeEnd_membership" name="dateRangeEnd_membership" type="text" data-date-format="dd-mm-yyyy" />
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Maximum Salary</label>
              <div class="col-sm-9">
                <input type="number" id="max_salary" name="max_salary" placeholder="" value="0" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

              <div class="col-sm-9">
                <textarea class="form-control" id="membership_remark" name="membership_remark" placeholder="" rows="4" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveMembership">Save</button>
            <input type="hidden" name="RecnumMembership" id="RecnumMembership" value="">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalFind" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="lbl-title-process"></label> <label> Find Employee</label></h4>
      </div>
      <form id="ProcessForm" name ="Form" class="grab form-horizontal" role="form">
        <div class="modal-body">
            <div class="col-sm-12" style="width: 100%" id="box-iframe">
              <iframe id="iframe" src="" style="width: 100%" scrolling="yes"></iframe>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-10">
            
          </div>
          <div class="col-sm-2 no-padding">
            <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            <input type="hidden" id="txtSelected" name="txtSelected" />
            <button type="button" id="btnFind" class="btn btn-primary btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Find</button>
          </div>
        </div>
    </div>
  </div>
</div>