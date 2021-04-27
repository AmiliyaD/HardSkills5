
@extends('../include')
@section('title')
    Event - Create Event
@endsection
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="events/index.html">Manage Events</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Все события</h1>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Создать новое событие</h2>
                </div>
            </div>

            <form class="needs-validation" method="POST" novalidate action="{{ route('detail') }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Название</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control is-invalid" id="inputName" name="name" placeholder="" value="{{old('name')}}">
                        <div class="invalid-feedback">
                          Название обязательно
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control" id="inputSlug" name="slug" placeholder="" value="{{old('slug')}}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputDate">Дата</label>
                        <input type="date"
                               class="form-control"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value="{{old('date')}}">
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Сохранить событие</button>
                <a href="{{ asset('index') }}" class="btn btn-link">Назад</a>
            </form>
            {{-- error на каждый input --}}
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
