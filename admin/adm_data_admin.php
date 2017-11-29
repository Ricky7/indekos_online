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
<link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="adm_ubah_pass.php">Ganti Password</a></li>
      <li class="active">Daftar Admin</li>
      <li><a href="adm_tambah_admin.php">Tambah Admin</a></li>
    </ol>
    <div class="col-md-5">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Opsi</th>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM tbl_admin ORDER BY id_admin asc";       
              $records_per_page=10;
              $newquery = $admin->paging($query,$records_per_page);
              $admin->daftarAdmin($newquery);
             ?>
             <tr>
                <td colspan="4" align="center">
              <div class="pagination-wrap">
                    <?php $admin->paginglink($query,$records_per_page); ?>
                  </div>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
        
            <div class="modal-body">
                <p>Apakah anda yakin?</p>
                <!-- <p class="debug-url"></p>
 -->            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-warning btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>
<!-- diletak dibawah agar tidak bentrok -->
<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    
    $('.debug-url').html('Alamat ID: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');

});
</script>
