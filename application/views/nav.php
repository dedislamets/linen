<?php $route = strtolower($this->uri->segment(1)) ?>

<ul class="nav">
<?php 
foreach (menu() as $key => $value) { 
 
  foreach ($value as $key_parent => $value_parent) { 
      if(count($value_parent['child']) > 0){
          if($value_parent['data'][0]['aktif'] > 0){
              echo '<li class="nav-item '. ($route == 'master' ? 'active show' : '') .'">
                      <a href="#" class="nav-link with-sub"><i class="'. $value_parent['data'][0]['icon'] .'"></i> '. $key_parent .' <i class="fa fa-angle-down ml-2"></i></a>';

                      echo '  <nav class="az-menu-sub">';
                      foreach ($value_parent['child'] as $key_child => $value_child) { 
                          echo '<a href="'.base_url(). $value_child['link'] .'" class="nav-link">'. $value_child['menu'] .'</a>';
                      }
                      echo '  </nav>';

              echo '</li>';
          }
      }else{
          if($value_parent['data'][0]['aktif'] > 0){
              echo '  <li class="nav-item '. ($route == 'master' ? 'active show' : '') .'">
                          <a href="' .base_url(). $value_parent['data'][0]['link'] .'"class="nav-link" >
                              <i class="feather '. $value_parent['data'][0]['icon'] .'"></i>'. $key_parent .'
                          </a>
                          
                      </li>';
          }
          
      }
  }
} ?>
</ul>