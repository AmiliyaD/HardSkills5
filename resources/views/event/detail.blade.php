@extends('../include')
@section('title')
    Event - Detail
@endsection

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          
          @include('over')
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$one->name}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('edit', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">Редактировать событие</a>
                        </div>
                    </div>
                </div>
                <span class="h6">{{$one->date}}</span>
            </div>
            @include('../flash')
            <!-- Tickets -->
            <div id="tickets" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Билеты</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('ticket', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Создать новый билет
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
                            <p class="card-text">Цена: {{$item->cost}} $</p>
                      
                            <p  class="card-text">Тип: 
                                @if ($item->special_validity == 'amount')
                              <i>количество  </i>  
                            @endif
                            @if ($item->special_validity == 'date')
                       <i>  дата</i>
                            @endif</p>


                            @if ($item->special_validity == 'amount')
                                <p class="card-text">Макс. количество билетов: {{$item->max_sold}} шт.</p>    
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
                    <h2 class="h4">Сессии</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('createSession', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                            Создать новую сессию
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive sessions">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Время</th>
                        <th>Tип</th>
                        <th class="w-100">Заголовок</th>
                        <th>Спикер</th>
                        <th>Канал</th>
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
                    <h2 class="h4">Каналы</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('channelCreate', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                               Создать новый канал
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
                            <p class="card-text">{{$chan->Session->count()}} сессии,
                                @if ($chan->Rooms->count() >= 5 || $chan->Rooms->count() == 0)
                                {{$chan->Rooms->count()}}   комнат
                                @elseif($chan->Rooms->count() == 1 )
                                {{$chan->Rooms->count()}}   комната
                                @else 
                                {{$chan->Rooms->count()}}   комнаты
                                @endif
                                
                                </p>
                        </div>
                    </div>
                </div>
                @endforeach  
                @endif

          
            </div>

            <!-- Rooms -->
            <div id="rooms" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Комнаты</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('createRoom', ['id'=>$one->id]) }}" class="btn btn-sm btn-outline-secondary">
                                Создать новую комнату
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive rooms">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Вместимость</th>
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
