<!-- Zero configuration table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><?=ucwords($title_module)?></h4>
          <div class="pull-right">
                          <a href="<?=url("pimpinan/add")?>" class="btn btn-success btn-flat"><i class="fa fa-file btn-icon-prepend"></i> Add</a>
                                      <button type="button" id="filter-show" class="btn btn-primary btn-flat"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> Filter</button>
                      </div>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <form autocomplete="off" class="content-filter">
              <div class="row">
                                  <div class="form-group col-md-6">
                                          <input type="text" id="nama" class="form-control form-control-sm" placeholder="Nama" />
                                      </div>

                                  <div class="form-group col-md-6">
                                          <select class="form-control form-control-sm select2" data-placeholder=" -- Select Jabatan -- " name="jabatan" id="jabatan">
                        <option value=""></option>
                                                  <option value="Komisaris Utama">Komisaris Utama</option>
                                                  <option value="Komisaris Independent">Komisaris Independent</option>
                                                  <option value="Komisaris">Komisaris</option>
                                                  <option value="Direktur Utama">Direktur Utama</option>
                                                  <option value="Direktur Keuangan, Human, Capital & Manajemen Risiko">Direktur Keuangan, Human, Capital & Manajemen Risiko</option>
                                                  <option value="Direktur Pemasaran & Pengembangan">Direktur Pemasaran & Pengembangan</option>
                                                  <option value="Direktur Teknik & Produksi">Direktur Teknik & Produksi</option>
                                                  <option value="Direktur Operasi & Supply Chain Management">Direktur Operasi & Supply Chain Management</option>
                                                  <option value="Sekretaris Perusahaan">Sekretaris Perusahaan</option>
                                              </select>
                                      </div>

                                  <div class="form-group col-md-6">
                                          <input type="text" id="image" class="form-control form-control-sm" placeholder="Image" />
                                      </div>

                              </div>
              <div class="pull-right">
                <button type='button' class='btn btn-default btn-sm' id="filter-cancel"><?=cclang("cancel")?></button>
                <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table display" name="table" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Image</th>
                    <th>#</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<script type="text/javascript">
  $(document).ready(function() {
    var table;
    //datatables
    table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "ordering": true,
      "searching": false,
      "info": true,
      "bLengthChange": false,
      oLanguage: {
        sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?= url("pimpinan/json")?>",
        "type": "POST",
         "data": function(data) {
                                          data.nama = $("#nama").val();
                                                        data.jabatan = $("#jabatan").val();
                                                        data.image = $("#image").val();
                                    }
              },

      //Set column definition initialisation properties.
      "columnDefs": [
        
					{
            "targets": 0,
            "orderable": false
          },

					{
            "targets": 1,
            "orderable": false
          },

					{
            "targets": 2,
            "orderable": false
          },

        {
          "className": "text-center",
          "orderable": false,
          "targets": 3
        },
      ],
    });

    $("#reload").click(function() {
                        $("#nama").val("");
                  $("#jabatan").val("");
                  $("#image").val("");
                    table.ajax.reload();
    });

          $(document).on("click", "#filter-show", function(e) {
        e.preventDefault();
        $(".content-filter").slideDown();
      });

      $(document).on("click", "#filter", function(e) {
        e.preventDefault();
        $("#table").DataTable().ajax.reload();
      })

      $(document).on("click", "#filter-cancel", function(e) {
        e.preventDefault();
        $(".content-filter").slideUp();
      });
    
    $(document).on("click", "#delete", function(e) {
      e.preventDefault();
      $('.modal-dialog').addClass('modal-sm');
      $("#modalTitle").text('<?=cclang("confirm")?>');
      $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
                              <div class="pull-right">
  														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
  	                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=` + $(this).attr('alt') + `  data-url=` + $(this).attr('href') + `><?=cclang("delete_action")?></button>
  														</div>`);
      $("#modalGue").modal('show');
    });


    $(document).on('click', '#ya-hapus', function(e) {
      $(this).prop('disabled', true)
        .text('Processing...');
      $.ajax({
        url: $(this).data('url'),
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function(json) {
          $('#modalGue').modal('hide');
          swal(json.msg, {
            icon: json.type_msg
          });
          $('#table').DataTable().ajax.reload();
        }
      });
    });


  });
</script>