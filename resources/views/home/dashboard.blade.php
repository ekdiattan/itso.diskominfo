@extends('home.partials.main')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
@section('container')
<section class="content connectedSortable">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="IT")
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3 id="count1">{{$laporan}}</h3>
                    <p>Data Catatan IT</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-book"></i>
                  </div>
                  <a href="/laporan" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
        
          @endif
        @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Aset")
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="count2">{{$booking}}</h3>
                <p>Data Peminjaman</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="/booking" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endif
          <!-- ./col -->
        @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3 style="color:#ffffff" id="count3">{{$pegawai}} {{$nonpns}}</h3>
                <p style="color:#ffffff"> Data Pegawai PNS {{$pegawai}} & Non PNS {{$nonpns}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/master-pegawai" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endif
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->

<!-- Card -->
  <h1>Berita</h1>
  <div class="row">
    <div class="col-sm-4">
      <div class="card" style="width: 18rem;">
        <img src="https://diskominfo.jabarprov.go.id/application/modules/post/images/WEB.png" class="card-img-top" alt="...">
            <div class="card-body">
          <h5 class="card-title">Diskominfo Jabar</h5>
        <p class="card-text">Pengumuman 10 Finalis DATATHON - JABAR GEORESTART TAHUN 2022</p>
      <a href="https://diskominfo.jabarprov.go.id/blog/875-Pengumuman-10-Finalis-DATATHON---JABAR-GEORESTART-TAHUN-2022" class="btn btn-primary">Ke Berita</a>
  </div>
      </div>
        </div>
<div class="col-sm-4">
  <div class="card" style="width: 18rem;">
    <img src="https://diskominfo.jabarprov.go.id/application/modules/post/images/10_Besar_Datathon@4x1.png" class="card-img-top" alt="...">
      <div class="card-body">
          <h5 class="card-title">Diskominfo Jabar</h5>
        <p class="card-text">PENGUMUMAN 10 BESAR SATU DATA JABAR AWARDS TAHUN 2022</p>
      <a href="https://diskominfo.jabarprov.go.id/blog/878-PENGUMUMAN-10-BESAR-SATU-DATA-JABAR-AWARDS-TAHUN-2022" class="btn btn-primary">Ke Berita</a>
       </div>
  </div>
</div>
    <div class="col-sm-4">
    <div class="card" style="width: 18rem;">
        <img src="https://diskominfo.jabarprov.go.id/application/modules/post/images/25_5_Bimtek_Jafung@1.5x_1.png" class="card-img-top" alt="...">
            <div class="card-body">
          <h5 class="card-title">Diskominfo Jabar</h5>
        <p class="card-text">Bimbingan Teknis Jabatan Fungsional Diskominfo Jabar</p>
      <a href="https://diskominfo.jabarprov.go.id/blog/872-Bimbingan-Teknis-Jabatan-Fungsional-Diskominfo-Jabar" class="btn btn-primary">Ke Berita</a>
    </div>
  </div>
</div>
</div>
<br>


<script>
  // Mendapatkan elemen target
  var countElement1 = document.getElementById('count1');
  var countElement2 = document.getElementById('count2');
  var countElement3 = document.getElementById('count3');
  var startCount = 0;

  var endCount1 = {{$laporan}}; // Ganti dengan variabel atau ekspresi yang sesuai dengan nilai $
  var endCount2 = {{$booking}}; 
  var endCount3 = {{$pegawai}} + {{$nonpns}}; 
  
  var duration = 2000;
  
  // JANGAN DI EDIT
  function countingEffect(countElement, endCount) {
    var countDiff = endCount - startCount;
    var interval = Math.ceil(duration / countDiff);
    var currentCount = startCount;
    var timer = setInterval(function () {
      currentCount++;
      countElement.innerText = currentCount;
      if (currentCount === endCount) {
        clearInterval(timer);
      }
    }, interval);
  }
  // END AKHIR EDIT
  
  
  // Memulai efek hitungan untuk setiap elemen
  if({{ $laporan }} != '0'){
  countingEffect(countElement1, endCount1);
  }
  if({{ $booking }} != '0'){
    countingEffect(countElement2, endCount2);
  }
  if({{ $pegawai }} != '0'){
  countingEffect(countElement3, endCount3);
  }
</script>


<!-- <script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [10, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script> -->
@endsection