@extends('include')
@section('title')
    Event Backend
@endsection
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Manage Events</a></li>
                    </ul>
                </div>
            </nav>
   
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Events</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('create') }}" class="btn btn-sm btn-outline-secondary">Create new event</a>
                        </div>
                    </div>
                </div>

                <div class="row events">
                    @foreach ($event as $eve)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <a href="{{ route('detail', $eve->id) }}" class="btn text-left event">
                                <div class="card-body">
                                    <h5 class="card-title">{{$eve->name}}</h5>
                                    <p class="card-subtitle">{{$eve->date}}</p>
                                    <hr>
                                    <p class="card-text">{{ $eve->registrations->count() }} registrations</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                  
                </div>
    
            </main>
        </div>
    </div>

    </body>
    </html>

