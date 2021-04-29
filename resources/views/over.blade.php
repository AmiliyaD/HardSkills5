<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Все события</a></li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>{{$one->name}}</span>
    </h6>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="{{ route('detail', ['id'=>$one->id]) }}">Просмотр события</a></li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Диаграммы</span>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item"><a class="nav-link" href="{{ route('report', ['id'=>$one->id]) }}">Вместимость комнат</a></li>
    </ul>
</div>