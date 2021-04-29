@extends('../include')
@section('title')
    Event - Create Room
@endsection
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">

            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Все события</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{$roomEvent->name}}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('detail', ['id'=>$roomEvent->id]) }}">Просмотр события</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Диаграммы</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('report', ['id'=>$roomEvent->id]) }}">Вместиомсть комнаты</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$roomEvent->name}}</h1>
                </div>
                <span class="h6">{{$roomEvent->date}}</span>
            </div>
            @include('../flash')
            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Создать новую комнату</h2>
                </div>
            </div>

            <form class="needs-validation" method="POST" novalidate action="{{ route('storeRoom', ['id'=>$roomEvent->id]) }}">
@csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Название</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control is-invalid" id="inputName" name="name" placeholder="" value="">
                        <div class="invalid-feedback">
                         Название обязательно
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectChannel">Канал</label>
                        <select class="form-control" id="selectChannel" name="channel">
                            @foreach ($channelGet as $item)
                            <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                    
                        </select>
                    </div>
                </div>
                <input type="hidden" name="event_id" value='{{$roomEvent->id}}' >
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCapacity">Вместимость</label>
                        <input type="number" class="form-control" id="inputCapacity" name="capacity" placeholder="" value="">
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Сохранить комнату</button>
                <a href="{{ route('detail', $roomEvent->id) }}" class="btn btn-link">Назад</a>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </main>
    </div>
</div>

</body>
</html>
