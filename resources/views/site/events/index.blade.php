@extends('layouts.main')
@section('title','Eventos')

@section('content')

    <section class="banner row align-items-center mx-0">
        <div class="container col" style="max-width: 1200px">
            <h1 class="display-4 text-center text-light">Busque por eventos</h1>
            <form>
                <input class="form-control form-control-lg" type="text" name="search" placeholder="Pesquisar..." aria-label=".form-control-lg example">
            </form>
        </div><!--container-->
    </section><!--banner-->
    <section class="events py-5">
        <div class="container">
            @if($search)
                <h1>Buscando por: {{ $search }}</h1>
            @else
                <h1>Próximos Eventos</h1>
                <h5 class="text-black-50">Veja os Eventos dos próximos dias</h5>
            @endif
            @if(count($events) > 0)
                <div class="row row-cols-4 justify-content-around">
                @foreach($events as $event)
                    <div class="card col p-0 my-3" style="width: 18rem;">
                        <img src="/images/events/{{ $event->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="text-black-50 m-0">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="card-text text-black-50">{{ count($event->users) }} participantes</p>
                            <a href="{{ route('event.single',['id'=>$event->id]) }}" class="btn btn-primary">Saiba Mais!</a>
                        </div><!--card-body-->
                    </div><!--card-->
                @endforeach
                </div><!--row-colls-4-->
            @else
                <h4 class="text-black-50 text-center">Sem eventos</h4>
            @endif

        </div><!--container-->
    </section><!--events-->
@endsection
