@extends('../include')
@section('title')
    Room Capacity
@endsection
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="events/index.html">Manage Events</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{$event->name}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="events/detail.html">Overview</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('report', ['id'=>$event->id]) }}">Room capacity</a></li>
                </ul>
            </div>
        </nav>
       
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$event->name}}</h1>
                </div>
                <span class="h6">{{$event->date}}</span>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Room Capacity</h2>
                </div>
            </div>
            @foreach ($event->chanells as $chans)
            @foreach ($chans->rooms as $room)
         
               @foreach ($room->sessions as $sessions)
               
                   <input type="hidden" name="sessions" class="sessions" value="{{$sessions->title}}">
                   <input type="hidden" name="sessionReg" class="sessionReg" value="{{$sessions->sessionReg->count()}}">
                   
                   <input type="hidden" name="" class="capacity" value="{{$sessions->evId->capacity}}">
                   
               @endforeach
            @endforeach
            @endforeach
        <!-- TODO create chart here -->
            <canvas id="myChart"></canvas>

        </main>


    </div>
</div>



<script>
// КОЛ-ВО ЗАРЕГИСТРИРОВАННЫХ
let sessionReg = []

let reg = document.querySelectorAll('.sessionReg');
reg.forEach(function(item,index) {
    sessionReg.push(parseInt(item.value))
})
console.log(sessionReg)
// ВСЕГО МЕСТ
let capacity = [];
let a = document.querySelectorAll('.capacity')
a.forEach(function(item,index) {
   
    capacity.push(parseInt(item.value))
})
console.log(capacity)
// НАЗВАНИЯ СЕССИИ
let sessionsName =  [];
let sessions = document.querySelectorAll('.sessions')
sessions.forEach(function(item,index) {
    
    sessionsName.push(item.value)
})

// ЕСЛИ КОЛ-ВО УЧАСТНИКОВ БОЛЬШЕ, ЧЕМ МЕСТ
let notPermited = []
// capacity.forEach(function(item,index) {
//     sessionReg.forEach(function(ses,ind) {
//         if (ses > item) {
//             notPermited.push(ses)
//         }
//     })
// })
for (let i = 0; i < sessionReg.length; i++) {

    // console.log(capacity[i] + ' capac')
    
        if (sessionReg[i] > capacity[i]) {
        console.log(sessionReg[i])
    }
    
    
}

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{ asset('js/diagram.js') }}"></script>
</body>
</html>
