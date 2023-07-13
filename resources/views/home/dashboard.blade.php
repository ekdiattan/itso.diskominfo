@extends('home.partials.main')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
@section('container')
<section class="content connectedSortable">

<div class="row">
	@foreach($mappingDashboard as $mappingDashboard)
<div class="col-md-4">
	<!-- small box -->
	<div class="small-box" style="background-color:{{$mappingDashboard->Warna}}">
		<div class="inner">
      <h3></h3>
		<p style="color:white;">{{$mappingDashboard->NameCard}}</p>
		</div>
		<div class="icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar2-week-fill" viewBox="0 0 16 16">
        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zM8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
    </svg>
		</div>
		<a href="{{$mappingDashboard->Route}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
@endforeach
</div>
</div>

  </section>

<br>


<script>
  // Mendapatkan elemen target
  var countElement1 = document.getElementById('count1');
  var countElement2 = document.getElementById('count2');
  var countElement3 = document.getElementById('count3');
  var countElement4 = document.getElementById('count4');
  var countElement5 = document.getElementById('count5');
  var countElement6 = document.getElementById('count6');
  var startCount = 0;

  
  
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
  
</script>

<script>
    // Ambil elemen card menggunakan id
    var statusCard = document.getElementById('status-card');
    if ({{ auth()->user()->is_checked ? 'true' : 'false' }}) {
        statusCard.style.display = 'block';
    } else {
        statusCard.style.display = 'none';
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