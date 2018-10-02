@extends('master')

@section('title', 'Random · Success')

@section('content')
  <div class="row">
    <div class="col l8 m6 s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Success!</span>
          This item has successfully taken out from system :)
        </div>
      </div>
    </div>
    <div class="col l4 m6 s12">
      <div class="card">
        <div class="card-content">
          @include('module.menu')
        </div>
      </div>
    </div>
  </div>
@endsection