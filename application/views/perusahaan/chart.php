<?php
defined('BASEPATH') or exit('No direct script access allowed');
$setting = $this->db->get('setting');
$row = $setting->row();
?>
<style>
  @import "https://code.highcharts.com/css/highcharts.css";

  #container {
    height: 400px;
  }

  .highcharts-figure,
  .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
  }

  .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }

  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }

  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }

  .highcharts-data-table td,
  .highcharts-data-table th,
  .highcharts-data-table caption {
    padding: 0.5em;
  }

  .highcharts-data-table thead tr,
  .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }

  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<?php
$id = $this->session->userdata('id'); #ambil user nama login
$today = date("Y-m-d");
$lowonganaktif = $this->db->query("select lowongan.*,user.id_user from lowongan
 left join user on user.id_user=lowongan.id_user where lowongan.status='Aktif' and lowongan.tgl_tutup_loker>='$today' and lowongan.id_user='$id'")->num_rows();
$lowongantidakaktif = $this->db->query("select lowongan.*,user.id_user from lowongan
 left join user on user.id_user=lowongan.id_user where lowongan.tgl_tutup_loker<='$today' OR lowongan.status='Tutup Lowongan' and lowongan.id_user='$id'")->num_rows();
$lowongan = $this->db->query("select lowongan.*,user.id_user from lowongan
 left join user on user.id_user=lowongan.id_user where lowongan.id_user='$id'")->num_rows();
$id_user = $this->session->userdata('id');
$pencaker = $this->db->query("select lamar.*,count(lamar.id_user) as jml,lowongan.id_lowongan,lowongan.id_user from lamar
left join lowongan on lowongan.id_lowongan=lamar.id_lowongan
where lowongan.id_user='$id'");
$row = $pencaker->row();
?>
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="alert alert-primary" role="alert">
        <?php
        $q = $this->db->query("select * from setting");
        foreach ($q->result() as $xrow) {
        ?>
          <strong>Selamat Datang</strong> <?php echo $this->session->userdata("nama") ?> di WEBSITE <?php echo $xrow->web ?> <?php
                                                                                                                              if (function_exists('date_default_timezone_set'))
                                                                                                                                date_default_timezone_set('Asia/Jakarta');
                                                                                                                              ?> <span id="clock">&nbsp;</span>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon l-bg-purple">
              <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-wrap">
              <div class="padding-20">
                <div class="text-right">
                  <h3 class="font-light mb-0">
                    <i class="ti-arrow-up text-success"></i><?php echo $lowonganaktif ?>
                  </h3>
                  <span class="text-muted">Loker Aktif</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon l-bg-purple">
              <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-wrap">
              <div class="padding-20">
                <div class="text-right">
                  <h3 class="font-light mb-0">
                    <i class="ti-arrow-up text-success"></i><?php echo $lowongantidakaktif ?>
                  </h3>
                  <span class="text-muted">Loker Tidak Aktif</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon l-bg-cyan">
              <i class="fas fa-book"></i>
            </div>
            <div class="card-wrap">
              <div class="padding-20">
                <div class="text-right">
                  <h3 class="font-light mb-0">
                    <i class="ti-arrow-up text-success"></i><?php echo $lowongan ?>
                  </h3>
                  <span class="text-muted">Total Loker </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon l-bg-green">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="padding-20">
                <div class="text-right">
                  <h3 class="font-light mb-0">
                    <i class="ti-arrow-up text-success"></i><?php echo $row->jml ?>
                  </h3>
                  <span class="text-muted">Pencari Kerja</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div id="container"></div>
        </div>
      </div>
    </div>
  </section>
  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
      <div class=" fade show active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Select Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button">Light</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button">Dark</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Sidebar Color</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Color Theme</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Mini Sidebar</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Sticky Header</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
            <i class="fas fa-undo"></i> Restore Default
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$lowonganaktif = $this->db->query("select * from lowongan where status='Aktif'")->num_rows();
$lowongantutup = $this->db->query("select * from lowongan where status='Tutup Lowongan'")->num_rows();
?>
<script>
  Highcharts.chart('container', {

    chart: {
      type: 'pie',
      options3d: {
        enabled: true,
        alpha: 45,
        beta: 0
      }
    },

    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },

    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        depth: 35,
        dataLabels: {
          enabled: true,
          format: '{point.name}'
        }
      }
    },

    title: {
      text: 'Lowongan Kerja'
    },

    series: [{
      type: 'pie',
      allowPointSelect: true,
      name: 'Browser share',
      keys: ['name', 'y', 'selected', 'sliced'],
      data: [

        ['Aktif', <?php echo $lowonganaktif ?>, false],
        ['Tutup Lowongan', <?php echo $lowongantutup ?>, false],
      ],
      showInLegend: true
    }]
  });

  var d = new Date();
  var hours = d.getHours();
  var minutes = d.getMinutes();
  var seconds = d.getSeconds();
  var hari = d.getDay();
  var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  hariIni = namaHari[hari];
  var tanggal = ("0" + d.getDate()).slice(-2);
  var month = new Array();
  month[0] = "Januari";
  month[1] = "Februari";
  month[2] = "Maret";
  month[3] = "April";
  month[4] = "Mei";
  month[5] = "Juni";
  month[6] = "Juli";
  month[7] = "Agustus";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "Nopember";
  month[11] = "Desember";
  var bulan = month[d.getMonth()];
  var tahun = d.getFullYear();
  var date = Date.now(),
    second = 1000;

  function pad(num) {
    return ('0' + num).slice(-2);
  }

  function updateClock() {
    var clockEl = document.getElementById('clock'),
      dateObj;
    date += second;
    dateObj = new Date(date);
    clockEl.innerHTML = '' + hariIni + ',  ' + tanggal + ' ' + bulan + ' ' + tahun + ' | ' + pad(dateObj.getHours()) + ':' + pad(dateObj.getMinutes()) + ':' + pad(dateObj.getSeconds());
  }
  setInterval(updateClock, second);
</script>