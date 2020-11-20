@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    div h6{
        font-size: 14px;
    }
    div h5{
        font-size: 18px;
    }
    div .subCat{
        display: inline;
    }
    .buscar{
        width: 150px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert alert-success"><h4><strong>{{ __('Anuncios clasificados') }}</strong></h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        
                    <div class="row">
                    <div class="col-12">  {{-- collapse con las categorias y subcategorias --}}
                        @for ($i = 0; $i < count($categorias); $i++) {{-- busca las categorias en el array de subcategorias --}}
                        <div class="accordion" id="{{substr($categorias[$i], 1, 4)}}"> 
                            <div class="card">
                              <div class="card-header" id="{{substr($categorias[$i], 1, 3)}}"> 
                                    <div class="row">
                                        <div class="alert alert-info cardinfo col-8" role="alert">
                                        <button class="btn btn-link btn-block text-center btn-lg btn-block" type="button" data-toggle="collapse" data-target="#{{substr($categorias[$i], 0, 3)}}" aria-expanded="true" aria-controls="{{substr($categorias[$i], 0, 3)}}">
                                            <h5><strong>{{$categorias[$i]}}</strong></h5>
                                          </button>
                                      </div>
                                      <div class="col-4 text-center">
                                        <a href="{{route('anuncios.buscar', $categorias[$i])}}" class="btn btn-outline-info text-center mt-3 buscar" role="button">Ir a categoría {{$categorias[$i]}}</a> {{-- boton que busca 1 categoria especifica --}}
                                      </div>
                                    </div>   
                              </div>
                              @for ($e = 0; $e < count($subcategorias); $e++)
                              @if ($categorias[$i] == $subcategorias[$e][0]) {{-- busca las subcategorias con respectiva categoria --}}
                              <div id="{{substr($categorias[$i], 0, 3)}}" class="collapse" aria-labelledby="{{substr($categorias[$i], 1, 3)}}" data-parent="#{{substr($categorias[$i], 1, 4)}}">
                                    <button class="btn btn-outline-success btn-sm m-1">{{$subcategorias[$e][1]}} </button>
                              </div>
                              @endif
                              @endfor
                            @endfor
                            </div>
                          </div>
                    </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
