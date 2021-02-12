@extends('../include')
@section('title')
    Event - Detail
@endsection

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Manage Events</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{$one->name}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="events/detail.html">Overview</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('report', ['id'=>$one->id]) }}">Room capacity</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$one->name}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('edit', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">Edit event</a>
                        </div>
                    </div>
                </div>
                <span class="h6">{{$one->date}}</span>
            </div>
            @include('../flash')
            <!-- Tickets -->
            <div id="tickets" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Tickets</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('ticket', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Create new ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="row tickets">
         
                @if (isset($oneTick))
                @foreach ($oneTick as $item)
                    
           
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">Цена: {{$item->cost}}</p>
                      
                            <p  class="card-text">Type: {{$item->special_validity}}</p>
                            @if ($item->special_validity == 'amount')
                                <p class="card-text">{{$item->max_sold}} билетов осталось </p>    
                            @endif
                            @if ($item->special_validity == 'date')
                            <p class="card-text">Продажа до: {{$item->date_until}} </p> 
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
               
      
            </div>

            <!-- Sessions -->
            <div id="sessions" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Sessions</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('createSession', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Create new session
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive sessions">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Type</th>
                        <th class="w-100">Title</th>
                        <th>Speaker</th>
                        <th>Channel</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($one->chanells as $channe)
                        @foreach ($channe->rooms as $room)
                        @foreach ($room->sessions as $sessin)
                        <tr>
                        <td class="text-nowrap">{{$sessin->start}} - {{$sessin->end}}</td>
                        <td>{{$sessin->type}}</td>
                        <td><a href="{{ route('editSession', ['sessionId'=>$sessin->id, 'id'=>$one->id]) }}">{{$sessin->title}}</a></td>
                        <td class="text-nowrap">{{$sessin->speaker}}</td>
                        <td class="text-nowrap">{{$channe->name}} / {{$room->name}}</td>
                    </tr>
                        @endforeach
                        @endforeach  
                        @endforeach
                 
                    </tbody>
                </table>
            </div>

            <!-- Channels -->
            <div id="channels" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Channels</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('channelCreate', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Create new channel
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row channels">
                @if (isset($channel))
                @foreach ($channel as $chan)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{$chan->name}}</h5>
                            <p class="card-text">{{$session->count()}} sessions, {{$get->count()}} rooms</p>
                        </div>
                    </div>
                </div>
                @endforeach  
                @endif

          
            </div>

            <!-- Rooms -->
            <div id="rooms" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Rooms</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('createRoom', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Create new room
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive rooms">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capacity</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($one->chanells as $channe)
                        @foreach ($channe->rooms as $room)
                       
                        <tr>
                        <td>{{$room->name}}</td>
                        <td>{{$room->capacity}}</td>
                       
                     
                    </tr>
                 
                        @endforeach  
                        @endforeach
                 
                        {{-- @if (isset($get))
                        @foreach ($get as $roomGet)
                        <tr>
                      
                                
                           
                            <td>{{$roomGet->name}}</td>
                            <td>{{$roomGet->capacity}}</td>
                         
                        </tr>
                        @endforeach   
                        @endif --}}
                    
            
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

</body>
</html>
