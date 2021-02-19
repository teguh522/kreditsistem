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
          const api_url = "<?= base_url() ?>dashboard/get_laporan_kredit";
          async function chartbar() {
              try {
                  const response = await fetch(api_url);
                  const json = await response.text();
                  if (json.length > 0) {
                      let kategori = [];
                      let data = ['data1'];
                      JSON.parse(json).map((item) => {
                          kategori.push(`${item.nama_barang}`)
                          data.push(item.jumlahkredit)
                      })
                      var chart = c3.generate({

                          bindto: '#chart-bar', // id of chart wrapper
                          data: {
                              columns: [
                                  // each columns data
                                  data,
                              ],
                              type: 'area-spline', // default type of chart
                              colors: {
                                  'data1': 'tomato', // blue            
                              },
                              names: {
                                  // name of each serie
                                  'data1': 'Kredit',
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