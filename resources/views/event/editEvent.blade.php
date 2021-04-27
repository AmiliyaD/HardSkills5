{{-- @include('../include')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$event->name}}</h1>
                </div>
            </div> --}}
@include('../eventHeader')
@section('title-2')
    Edit Session
@endsection
            <form class="needs-validation" method="POST" novalidate action="{{ route('update', ['id'=>$event->id]) }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Название</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control is-invalid" name="name" id="inputName" placeholder="" value="">
                        <div class="invalid-feedback">
                           Название обязательно
                        </div>
                    </div>
                </div>
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="inputSlug" placeholder="" value="">
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
                               value="">
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Сохранить</button>
                <a href="{{ route('detail', $event->id) }}" class="btn btn-link">Назад</a>
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
