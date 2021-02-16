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

      $('.kirimsaldo').click(function() {
          const customer_id = $(this).data("id");
          const amount = $(this).data("saldo");
          const id_user_tugas = $(this).data("id_user_tugas");
          Swal.fire({
              title: 'Are you sure?',
              text: "Saldo user ini akan di kirim ke olshop.id",
              icon: 'warning',
              input: 'radio',
              inputOptions: {
                  0: 'Saldo',
                  1: 'Penghasilan'
              },
              inputValidator: (value) => {
                  if (!value) {
                      return 'You need to choose something!'
                  }
              },

              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '<?= base_url('paneladmin/post_saldo') ?>',
                      method: 'post',
                      cache: false,
                      dataType: 'json',
                      data: {
                          customer_id,
                          amount,
                          id_user_tugas,
                          earning: result.value
                      },
                      success: function(data) {
                          if (data.status) {
                              Swal.fire({
                                  text: data.message,
                                  icon: 'success',
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000,
                              })
                              $(`#kirimsaldo${id_user_tugas}`).hide();
                          } else {
                              Swal.fire({
                                  text: data.message,
                                  icon: 'error',
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000,
                              })
                          }

                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          Swal.fire({
                              text: "Error koneksi",
                              icon: 'error',
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                          })
                      }
                  })

              }
          })
      })
      $('.broadcastwa').click(function() {
          const akuntype = $(this).data("id");
          const idtugas = $(this).data("id-tugas");
          Swal.fire({
              title: 'Are you sure?',
              text: 'Notifikasi akan di kirim ke seluruh akun group ini',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '<?= base_url('paneladmin/getuserbytype') ?>',
                      method: 'post',
                      cache: false,
                      dataType: 'json',
                      data: {
                          id: akuntype,
                          idtugas,
                      },
                      success: function(data) {

                          if (data.status) {
                              let hp = [];
                              data.data.map(item => {
                                  hp.push(item.telephone)
                              })
                              $.ajax({
                                  url: '<?= base_url('paneladmin/broadcastwa') ?>',
                                  method: 'post',
                                  cache: false,
                                  dataType: 'json',
                                  data: {
                                      hp,
                                  },
                                  success: function(data) {
                                      Swal.fire({
                                          text: "Berhasil",
                                          icon: 'success',
                                          toast: true,
                                          position: 'top-end',
                                          showConfirmButton: false,
                                          timer: 3000,
                                      })
                                      window.location.href = '<?= base_url('paneladmin') ?>'
                                  }
                              })

                          } else {
                              Swal.fire({
                                  text: data.message,
                                  icon: 'error',
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000,
                              })
                          }

                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          Swal.fire({
                              text: "Error koneksi",
                              icon: 'error',
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                          })
                      }
                  })

              }
          })
      })
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
          $('#summernote').summernote({
              //   toolbar: [
              //       ['style', ['bold', 'italic', 'underline', 'clear']],
              //       ['font', ['strikethrough', 'superscript', 'subscript']],
              //       ['fontsize', ['fontsize']],
              //       ['color', ['color']],
              //       ['para', ['ul', 'ol', 'paragraph']],
              //       ['height', ['height']],
              //   ],
              //   placeholder: 'Kualifikasi Loker',
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


          const nextid = $('#next_id').val();
          $("#myupload").dropzone({
              url: "<?= base_url() ?>panelpromotor/proses_upload_multiple",
              acceptedFiles: 'image/*',
              paramName: "userimg",
              maxFilesize: 4,
              method: "post",
              addRemoveLinks: true,
              sending: function(a, b, c) {
                  a.token = Math.random();
                  a.id_laporan = nextid;
                  c.append("token_foto", a.token);
                  c.append("id_laporan_kerja", a.id_laporan);
              },
              removedfile: function(file) {
                  const token = file.token;
                  $.ajax({
                      type: "post",
                      data: {
                          token: token
                      },
                      url: "<?php echo base_url('panelpromotor/remove_foto') ?>",
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

          const api_url = "<?= base_url() ?>dashboard/get_laporan_saldo";
          async function chartbar() {
              try {
                  const response = await fetch(api_url);
                  const json = await response.text();
                  if (json.length > 0) {
                      let kategori = [];
                      let data = ['data1'];
                      JSON.parse(json).map((item) => {
                          kategori.push(`Bulan Ke ${item.bulan}`)
                          data.push(item.totalpengeluaran)
                      })
                      var chart = c3.generate({

                          bindto: '#chart-bar', // id of chart wrapper
                          data: {
                              columns: [
                                  // each columns data
                                  data,
                              ],
                              type: 'line', // default type of chart
                              colors: {
                                  'data1': '#007FFF', // blue            
                              },
                              names: {
                                  // name of each serie
                                  'data1': 'Pengeluaran',
                              }
                          },
                          axis: {
                              x: {
                                  type: 'category',
                                  // name of each category
                                  categories: kategori
                              },
                          },
                          bar: {
                              width: 16
                          },
                          legend: {
                              show: true, //hide legend
                          },
                          padding: {
                              bottom: 20,
                              top: 0
                          },
                      });
                  }
              } catch (error) {
                  console.log(error);
              }
          }
          chartbar()
      });
  </script>
  </body>

  </html>