<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();

?>

<?php
  include "adm_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Library</a></li>
      <li class="active">Data</li>
    </ol>
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>asdfasdfa</th>
            <th>asafasdf</th>
            <th>aasdfsadf</th>
          </thead>
          <tbody>
            <tr>
              <td>aasdfasdf</td>
              <td>aasdfasdf</td>
              <td>aasdfasdf</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
