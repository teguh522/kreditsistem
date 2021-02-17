  <script src="<?php echo base_url() ?>assets/vendor/bundles/libscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/vendorscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/mainscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/c3.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/dropify/js/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/forms/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/datatablescripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tables/jquery-datatable.js"></script>
  <!-- include summernote css/js -->
  <link href="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.css" rel="stylesheet">
  <script src="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.js"></script>

  <script src="<?php echo base_url() ?>assets/vendor/sweetalert2.min.js"></script>

  <link href="<?php echo base_url() ?>assets/vendor/select2.min.css" rel="stylesheet" />
  <script src="<?php echo base_url() ?>assets/vendor/select2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/dropzone.min.js"></script>
  <script>
      function detailimg(id) {
          $.ajax({
              type: "post",
              data: {
                  id: id
              },
              url: "<?php echo base_url('paneladmin/getimagedetail') ?>",
              cache: false,
              dataType: 'json',
              success: function(data) {
                  $('img').remove('#imgdetail')
                  $.each(data.gambar, function(k, v) {
                      $("#detail-img-user").append(`
                      <p>Tgl upload(${v.upload_at})</p>
                      <img id="imgdetail" src = <?= base_url("upload/foto/") ?>${v.file} class = "img-fluid rounded mx-auto d-block"
                          width = "350px" >`)
                  });
                  $('.bd-example-modal-lg').modal('show')
              },
              error: function(xhr, status, error) {
                  console.log(error);

              }
          })

      }

      function detailimgadmin(id) {
          $.ajax({
              type: "post",
              data: {
                  id: id
              },
              url: "<?php echo base_url('panelpromotor/getlistimgadmin') ?>",
              cache: false,
              dataType: 'json',
              success: function(data) {
                  $('div').remove('#imgdetailadmin')
                  $.each(data.gambar, function(k, v) {
                      $("#detail-img-admin").append(`
                      <div id="imgdetailadmin text-centers">
                      <img src = <?= base_url("upload/foto/") ?>${v.file} class = "img-fluid rounded mx-auto d-block"
                          width = "350px" >
                          <br>
                          <a href="<?= base_url("upload/foto/") ?>${v.file}" download rel="noopener noreferrer" class="btn btn-primary btn-sm" title="Download Image">
                                    <span class="sr-only">Download Image</span>
                                    <i class="fa fa-download"></i></a>
                                    <br>
                                    <br>
                                    </div>
                          
                          `)
                  });
                  $('.bd-detail-img-admin').modal('show')
              },
              error: function(xhr, status, error) {
                  console.log(error);

              }
          })

      }

      function detailaporan(id) {
          $.ajax({
              type: "post",
              data: {
                  id: id
              },
              url: "<?php echo base_url('paneladmin/getlaporandetail') ?>",
              cache: false,
              dataType: 'json',
              success: function(data) {
                  $('div').remove('#id-detail-laporan')
                  $.each(data.data, function(k, v) {
                      $("#detail-laporan").append(`
                      <div id="id-detail-laporan">
                        <h4>${v.keterangan}(${v.tgl_lapor})</h4>
                        <button type="button" id="detail-img" onclick="detailimg(${v.id_laporan_tugas})" class="btn btn-round btn-info">Gambar Lain</button>
                        </div>
                        `)
                  });
                  $('#detaillaporan').modal('show')
              },
              error: function(xhr, status, error) {
                  console.log(error);

              }
          })

      }

      function detailcustomer(id) {
          $.ajax({
              type: "post",
              data: {
                  id: id
              },
              url: "<?php echo base_url('paneladmin/get_profile_customer') ?>",
              cache: false,
              dataType: 'json',
              success: function(data) {
                  const typeakun = {}
                  if (data.customer_group_id == '1') {
                      typeakun.akun = 'Pelanggan Basic'
                  } else if (data.customer_group_id == '7') {
                      typeakun.akun = 'Pelanggan Premium Harian'
                  } else if (data.customer_group_id == '8') {
                      typeakun.akun = 'Pelanggan Premium Mingguan'
                  } else if (data.customer_group_id == '2') {
                      typeakun.akun = 'Pelanggan Premium Bulanan'
                  } else if (data.customer_group_id == '6') {
                      typeakun.akun = 'Pelanggan Bisnis'
                  } else if (data.customer_group_id == '9') {
                      typeakun.akun = 'Agen Kurir'
                  } else {
                      typeakun.akun = 'Tidak ditemukan'
                  }

                  $('div').remove('#id-detail-customer')
                  $("#detail-customer").append(`
                          <div id="id-detail-customer">
                          <td><img src=${data.image_url} class="img-fluid rounded mx-auto d-block" width="150px"></td>
                          <div class="table-responsive">
                              <table  id="table-data" class="table table-striped table-hover dataTable">
                                  <tbody>
                                      <tr>
                                          <td>Nama</td>
                                          <td>${data.firstname} ${data.lastname}</td>
                                      </tr>
                                      <tr>
                                          <td>Type Akun</td>
                                          <td>${typeakun.akun}</td>
                                      </tr>
                                      <tr>
                                          <td>Email</td>
                                          <td>${data.email}</td>
                                      </tr>
                                      <tr>
                                          <td>Telp</td>
                                          <td>${data.telephone}</td>
                                      </tr>
                                      <tr>
                                          <td>Penghasilan</td>
                                          <td>Rp. ${data.penghasilan!=null?data.penghasilan.split(".")[0]:0}</td>
                                      </tr>
                                      <tr>
                                          <td>Saldo</td>
                                          <td>Rp. ${data.saldo!=null?data.saldo.split(".")[0]:0}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                            </div>
                            `)
                  $('#detailcustomer').modal('show')
              },
              error: function(xhr, status, error) {
                  console.log(error);

              }
          })
      }

      function uploadlainnya(id) {
          Dropzone.autoDiscover = false;

          $.ajax({
              type: "post",
              data: {
                  id: id
              },
              url: "<?php echo base_url('paneladmin/getlistimgadmin') ?>",
              cache: false,
              dataType: 'json',
              success: function(data) {
                  $('div').remove('#id-upload-image-multi')
                  $('div').remove('#myuploadadmin')

                  $.each(data.gambar, function(k, v) {
                      $("#upload-admin-multi").append(`
                      <div id="id-upload-image-multi" class="text-center">
                      <img src="<?= base_url("upload/foto/") ?>${v.file}"
                       class="img-fluid rounded mx-auto d-block" 
                       width="150px">
                       <br>
                        </div>
                        `)
                  });
                  $("#admin-image").append(`<div class="dropzone" id="myuploadadmin"></div>`)
                  $('#uploadlainnya').modal('show')
                  $("#myuploadadmin").dropzone({
                      url: "<?= base_url() ?>paneladmin/proses_upload_multiple",
                      acceptedFiles: 'image/*',
                      paramName: "adminimg",
                      maxFilesize: 4,
                      method: "post",
                      addRemoveLinks: true,
                      sending: function(a, b, c) {
                          a.token = Math.random();
                          a.id_tugas = id;
                          c.append("token_foto", a.token);
                          c.append("id_tugas", a.id_tugas);
                      },
                      removedfile: function(file) {
                          const token = file.token;
                          $.ajax({
                              type: "post",
                              data: {
                                  token: token
                              },
                              url: "<?php echo base_url('paneladmin/remove_foto') ?>",
                              cache: false,
                              dataType: 'json',
                              success: function() {
                                  console.log("Foto terhapus");
                              },
                              error: function(xhr, status, error) {
                                  console.log(error);

                              }
                          });
                          let _ref;
                          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                      }
                  });
              },
              error: function(xhr, status, error) {
                  console.log(error);

              }
          })


      }
  </script>

  <script>
      Dropzone.autoDiscover = false;
      $(function() {
          let searchParams = new URLSearchParams(window.location.search);
          if (searchParams.has('func')) {
              $('#form-hidden').show();
          } else {
              $('#form-hidden').hide();
          }
          $('#basic-form').parsley();
          $('#btntambah').on('click', function(e) {
              e.preventDefault();
              $('#form-hidden').show('slow');
          });
          $('#cari-pelanggan').select2({
              width: '100%',
              minimumInputLength: 2,
              ajax: {
                  type: "GET",
                  dataType: "json",
                  cache: false,
                  url: '<?= base_url() ?>paneladmin/get_penerima',
                  data: function(params) {
                      var query = {
                          param: params.term.replace(/ /g, " "),
                      }
                      return query;
                  },
                  processResults: function(data) {
                      return {
                          results: $.map(data, function(item) {
                              return {
                                  text: `${item.nama_pel} | ${item.no_ktp}`,
                                  id: item.id_pelanggan
                              }
                          })
                      };
                  }
              }
          });
          $('#cari-barang').select2({
              width: '100%',
              minimumInputLength: 2,
              ajax: {
                  type: "GET",
                  dataType: "json",
                  cache: false,
                  url: '<?= base_url() ?>paneladmin/get_barang',
                  data: function(params) {
                      var query = {
                          param: params.term.replace(/ /g, " "),
                      }
                      return query;
                  },
                  processResults: function(data) {
                      return {
                          results: $.map(data, function(item) {
                              return {
                                  text: `${item.nama_barang} | ${item.hpp}`,
                                  id: item.id_barang
                              }
                          })
                      };
                  }
              }
          });
          $('#cari-barang').on('select2:select', function(e) {
              const data = e.params.data;
              const text = data.text.split('|')
              const hpp = text[1];
              $("#hpp").val(hpp)
          });

          $('#summernote').summernote({
              tabsize: 2,
              height: 230
          });
          $("#inputPassword").on('click', function() {
              var x = document.getElementById("password");
              if (x.type === "password") {
                  x.type = "text";
              } else {
                  x.type = "password";
              }
          })
          $('#bayarangsuranmodal').on('show.bs.modal', function(e) {
              let id = $(e.relatedTarget).data('id-kredit');
              $.ajax({
                  type: "post",
                  url: "<?= base_url('/paneladmin/getangsuran') ?>",
                  cache: false,
                  dataType: "json",
                  data: {
                      id
                  },
                  success: function(data) {
                      $('div').remove('#detailjawaban')
                      data.map((item, index) => {
                          $("#jawabaninterview").append(`
                                <div id='detailjawaban'>
                                <label><b> Angsuran Ke: ${index+1}</b></label><br>
                                <label>Tanggal : ${item.created_at}</label><br>
                                <label>Nominal : ${new Intl.NumberFormat('ID', { style: 'currency', currency: 'IDR' }).format(item.jumlah_angsuran)}</label>
                            `)
                      })
                  }
              })
              $(e.currentTarget).find('#tampilid').val(id);
          });
          $('#btnsimpanjwb').on('click', function() {
              $.ajax({
                  type: "POST",
                  url: "<?= base_url('/paneladmin/create_angsuran') ?>",
                  data: {
                      'id_kredit': $('#tampilid').val(),
                      'jumlah_angsuran': $('#jumlah_angsuran').val(),
                  },
                  cache: false,
                  success: function(data) {
                      $('#bayarangsuranmodal').modal('toggle')
                      window.location = "<?= base_url('paneladmin/angsuran') ?>"
                  },
                  error: function() {
                      alert('Gagal simpan data');
                  }
              });
          })


      });
  </script>
  </body>

  </html>