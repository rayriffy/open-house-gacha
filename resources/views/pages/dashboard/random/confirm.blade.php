@extends('master')

@section('title', 'Random · Confirmation')

@section('content')
  <div class="row">
    <div class="col l8 m6 s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Confirmation</span>
          <div class="row">
            <div class="col s12">
              <div class="card">
                <div class="card-content">
                  <div class="row">
                    <div class="col s3">
                      Name
                    </div>
                    <div class="col s9">
                      <b>{{ $item["name"] }}</b>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s3">
                      Amount Left
                    </div>
                    <div class="col s9">
                      <b>{{ $item["amount"] }}</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <form action="{{ route('system.item.take') }}" method="POST">
              @csrf
              <input type="hidden" name="ref" value="{{ $item["ref"] }}">
              <button type="submit" class="col s6 btn green waves-effect waves-light">CONFIRM</button>
            </form>
            <a href="{{ route('dashboard.random') }}" class="col s6 btn red waves-effect waves-light">REFRESH</a>
          </div>
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