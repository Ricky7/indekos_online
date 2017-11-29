<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";
  require_once "../class/Indekos.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  $indekos = new Indekos($db);

?>
<?php
  include "lapak_header.php";
?>
<link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Daftar Indekos</li>
      <li><a href="lapak_input_indekos.php">Input Indekos</a></li>
    </ol>
    <div class="col-md-12">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Daftar Indekos</h3>
        </div>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <th>#</th>
                <th>Judul</th>
                <th>Kelas</th>
                <th>Harga</th>
                <th>Status</th>
                <th colspan="3" style="text-align:center;">Opsi</th>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_indekos WHERE id_seller={$getID} ORDER BY id_indekos asc";       
                  $records_per_page=10;
                  $newquery = $seller->paging($query,$records_per_page);
                  $indekos->daftarIndekos($newquery);
                 ?>
                 <tr>
                    <td colspan="8" align="center">
                  <div class="pagination-wrap">
                        <?php $seller->paginglink($query,$records_per_page); ?>
                      </div>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>

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
                <h4 class="modal-title" id="myModalLabel">Hapus Data ?</h4>
            </div>
        
            <div class="modal-body">
                <p>Data ini akan dihapus selamanya</p>
                <p>Tetap Lanjutkan ?</p>
                <!-- <p class="debug-url"></p> -->
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');

});
</script>