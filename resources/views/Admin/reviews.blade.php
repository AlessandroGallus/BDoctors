@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>REVIEWS</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Data</th>
          <th scope="col">Voto</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reviews as $key=>$review)
            
        
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$review['description']}}</td>
          <td>{{$review['created_at']}}</td>
          <td>{{$review['vote']}}</td>
        </tr>
        


        @endforeach
      </tbody>
    </table>
    <div class="canvas">
      <canvas id="ReviewChart">

      </canvas>
      <canvas id="AverageChart">

      </canvas>
    </div>
    
  </div>

@endsection
@push('scripts')

<script>

  let reviews = {!! json_encode($reviews->toArray()) !!};
  console.log(reviews);



  let arrayDates =[];
  let arrayValues ={};
  let arrayAverage ={};
  let i=0;

  reviews.forEach(review => {
    let date = new Date(review['created_at']);
    let trueDate = (date.getMonth()+1)+'/'+date.getFullYear();

    if(!arrayDates.includes(trueDate)){
      arrayDates.push(trueDate);
    }

  });

  arrayDates.forEach(date => {
    arrayValues[date]=i;
    arrayAverage[date]=i;
  });

  reviews.forEach(review => {
    let date = new Date(review['created_at']);
    let trueDate = (date.getMonth()+1)+'/'+date.getFullYear();
    

    arrayValues[trueDate]+=1;
    arrayAverage[trueDate]+=review['vote'];

  });
  arrayDates.forEach((element, index)=>{
    arrayAverage[element]=arrayAverage[element]/arrayValues[element];
  })

  console.log(arrayDates);
  console.log(arrayValues);


  let rchart = document.getElementById('ReviewChart').getContext('2d');
  let ReviewChart = new Chart(rchart,{
    type:'bar',
    data:{
      labels:arrayDates,
      datasets:[{
        label:'Numero Recensioni',
        data: arrayValues       
      }]
    },
    oprions:{},
  });




  let achart = document.getElementById('AverageChart').getContext('2d');
  let AverageChart = new Chart(achart,{
    type:'bar',
    data:{
      labels:arrayDates,
      datasets:[{
        label:'Media Voti',
        data: arrayAverage      
      }]
    },
    oprions:{},
  });

  
</script>

@endpush