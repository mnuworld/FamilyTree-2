<div id="main" class="ym-clearfix" role="main">
    <?php
function child($where){
    $info = user::find_where($where);
    foreach ($info as $arr) {?>
<li><?=$arr->first_name;?></li>
  <?php if($arr->type=='1'){
      $id="parent_id='".$arr->id."'";?>

<ul><?php child($id);?></ul>
      
 <?php     }}}
      $where='parent_id=0';
      $data=  user::find_where($where);
      foreach ($data as $datum){?>
        <li><?=$datum->first_name;?></li>
        
    <?php if($datum->type=='1'){
      $id="parent_id='".$datum->id."'"; ?>       
        <ul> <?php child($id);?></ul>   <?php }}?> 
</div>




