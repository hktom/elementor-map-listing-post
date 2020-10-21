<?php
function form_search(){
    ?>

<form class="my-1" method="get" action="<?php global $wp; echo home_url( $wp->request );?>">
  <div class="form-group mb-0">
    <input type="hidden" id="page-url" value="<?php global $wp; echo home_url( $wp->request );?>"/>
    <input type="search" class="form-control" name="q" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Rechercher une solution">
  </div>
</form>

    <?php
}
