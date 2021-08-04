@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>MESSAGGI:</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Mail</th>
          <th scope="col">Data</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($messages as $key=>$message)


        <tr>
          <th scope="row">{{$key}}</th>
          <td>{{$message['mail']}}</td>
          <td>{{$message['created_at']}}</td>
          <td><a href="{{route('messages.show',$message['id'])}}"><button class="btn btn-primary">VIEW</button></a> <form class="d-inline" action="{{route('messages.destroy',$message['id'])}}" method="POST">@csrf @method('DELETE') <button class="btn btn-danger" type="submit">DELETE</button></form> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="canvas">
      <canvas id="MessageChart">

      </canvas>
    </div>
  </div>
@endsection
@push('scripts')

<script>

  let messages = {!! json_encode($messages->toArray()) !!};
  console.log(messages);



  let arrayDates =[];
  let arrayValues ={};
  let i=0;

  messages.forEach(message => {
    let date = new Date(message['created_at']);
    let trueDate = (date.getMonth()+1)+'/'+date.getFullYear();

    if(!arrayDates.includes(trueDate)){
      arrayDates.push(trueDate);
    }

  });

  arrayDates.forEach(date => {
    arrayValues[date]=i;
  });
  messages.forEach(message => {
    let date = new Date(message['created_at']);
    let trueDate = (date.getMonth()+1)+'/'+date.getFullYear();

    arrayValues[trueDate]+=1;

  });
  console.log(arrayDates);
  console.log(arrayValues);

  let mchart = document.getElementById('MessageChart').getContext('2d');
  let MessageChart = new Chart(mchart,{
    type:'bar',
    data:{
      labels:arrayDates,
      datasets:[{
        label:'Numero Messaggi',
        data: arrayValues
      }]
    },
    oprions:{},
  });

</script>

@endpush
