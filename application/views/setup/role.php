<div class="container mn-ht-100p">
    <div class="content-wrapper w-100">
        <div class="row" id="app">
            <div class="col-md-12">
                <div class="card">
            
                    <div class="card-block" style="padding-top: 10px;">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card card-circle-chart mb-5">
                                    <div class="card-header">
                                        <h4 class="card-title lighter smaller">Group User 
                                        </h4>
                                    </div>

                                    <div class="card card-body bd-0">
                                        <div class="widget-main padding-8">
                                            <div class="col-sm-12" style="padding: 0" > 
                                                <input type="hidden" name="txtRecnumGroupUser" id="txtRecnumGroupUser" value="0" >
                                            <?php 
                                            foreach($group_role as $row)
                                            { ?>
                                                <p>
                                                    <button class="btn btn-primary btn-block btnGroup" data-id="<?php echo $row->id ?>" ><?php echo $row->group ?></button>
                                                </p>
                                            <?php }?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9">
                                <div class="p-20 z-depth-0 waves-effect" > 
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <button class="btn btn-primary btn-block" id="btnMenu" >Group {{ group_text }}</button> 
                                            <input type="hidden" id="txtRecnumGroup" name="txtRecnumGroup" :value="group_id">
                                            <div class="card">
                                                <div class="card-header" style="padding: 15px 20px;">
                                                  <h5>Pilih Menu</h5>
                                                </div>
                                                <div class="card card-body bd-0">
                                                  <div class="card-block tree-view p-t-0">
                                                    Search : <input type="text" name="search_field" id="search_field" value="" />  
                                                    <div id="basicTree">
                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xl-7">
                                            <h5>Menu Terpilih</h5> 
                                            <hr>
                                            <div class="row">

                                                <template v-for="menus in menu_selected">
                                                    <div class="col-xl-6 mb-1">
                                                        <button class="btn btn-mini btn-inverse btn-square btn-block btnMenuPilih" :data-id="menus.id_group_menu"  @click="loadPermission(menus.id_group_menu, menus.menu)" >{{ menus.menu }}</button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>
