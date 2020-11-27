@extends('layouts.app')

@section('body-class', 'profile-page')
@section('content')

<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Producto</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('searches.index') }}"> Atras</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <strong>No. de Producto:</strong>
                        {{ $product->id }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <strong>nombre:</strong>
                       
                        {{ $product->name }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <strong>Precio:</strong>
                       
                       Q {{ $product->price }} .00
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <strong>Categoria:</strong>
                        {{ $product->category_id }}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <strong>Foto:</strong>
                        <img src="{{$product->img}}" alt="profile Pic" height="200" width="200">
                    </div>
                </div>


               

            </div>
           
        </div>
        @endsection
    </div>
</div>
</div>