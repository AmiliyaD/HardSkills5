@include('../eventHeader')

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Создать новый билет</h2>
                </div>
            </div>

            <form class="needs-validation" method="Post" novalidate action="{{ route('ticketStore', ['id'=>$event->id]) }}">
@csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Имя</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control is-invalid" id="inputName" name="name" placeholder="" value="">
                        <div class="invalid-feedback">
                            Имя обязательно
                        </div>
                    </div>
                </div>
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCost">Цена</label>
                        <input type="number" class="form-control" id="inputCost" name="cost" placeholder="" value="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectSpecialValidity">Специальное условие</label>
                        <select class="form-control" id="selectSpecialValidity" name="special_validity">
                            <option value="" selected>Нет</option>
                            <option value="amount">Ограниченное количество</option>
                            <option value="date">Продажа до определенного числа</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputAmount">Количество билетов</label>
                        <input type="number" class="form-control" id="inputAmount" name="amount" placeholder="" value="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputValidTill">Билеты можно продать до</label>
                        <input type="date"
                               class="form-control"
                               id="inputValidTill"
                               name="valid_until"
                               placeholder="yyyy-mm-dd HH:MM"
                               value="">
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Сохранить билет</button>
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
