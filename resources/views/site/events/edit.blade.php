@extends('layouts.main')
@section('title','Editar Evento')
@section('content')
    <section class="new-event py-5">
        <div class="container" style="max-width: 800px">
            <h1 class="text-center mb-3">{{ $event->title }}</h1>
            <form action="{{ route('event.update',['id'=>$event->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3>Imagem do Evento(Atual): </h3>
                <img class="img-thumbnail" src="/images/events/{{ $event->image }}" alt="Imagem do Evento">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Alterar Imagem</label>
                    <input name="image" type="file" class="form-control" id="inputGroupFile01" value="{{old('image')}}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Evento:</span>
                    <input type="text" value="{{ $event->title }}" class="form-control" name="title" placeholder="Nome do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Data do Evento:</span>
                    <input type="date" value="{{ $event->date->format('Y-m-d') }}" class="form-control" name="date" placeholder="Nome do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Cidade:</span>
                    <input type="text" name="city" value="{{ $event->city }}" class="form-control" placeholder="Cidade do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">O evento é privado?</label>
                    <select class="form-select" name="private" value="{{ $event->private }}" id="inputGroupSelect01">
                        <option disabled >Selecione</option>
                        <option value="0" {{ ($event->private == 1) ? 'selected' : '' }}>Não</option>
                        <option value="1" {{ ($event->private == 1) ? 'selected' : '' }}>Sim</option>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-text">Descrição</span>
                    <textarea class="form-control" name="description" aria-label="With textarea" placeholder="Descrição do evento...">{{ $event->description }}</textarea>
                </div>

                <h3 class="mt-2">Itens de infraestrutura:</h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Cadeiras" name="items[]" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cadeiras
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Palco" name="items[]" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        Palco
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Bebidas Grátis" name="items[]" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                        Bebidas Grátis
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Open food" name="items[]" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">
                        Open food
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Brindes" name="items[]" id="defaultCheck5">
                    <label class="form-check-label" for="defaultCheck5">
                        Brindes
                    </label>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Atualizar Evento</button>
                </div>
            </form>
        </div><!--container-->
    </section><!--new-=event-->

    <div class="p-5 mt-3 bg-light rounded-3">
        <div class="container-fluid py-5"></div>
    </div>
@endsection
