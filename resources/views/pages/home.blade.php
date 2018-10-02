@extends('master')

@section('title', 'Home')

@section('content')
  <div class="row">
    <div class="col l8 m6 s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Home</span>
          The very front page of this site
        </div>
      </div>
    </div>
    <div class="col l4 m6 s12">
      <div class="card">
        <div class="card-content">
          @if (Cookie::get('ticketdata') === null)
          <span class="card-title">Authentication Required</span>
          @if (session('errorcode'))
            @if (Session::get('errorcode') == 7001)
              <div class="chip red lighten-1 white-text col s12">
                <center>Invalid ticket
                <i class="close material-icons">close</i></center>
              </div>
            @elseif (Session::get('errorcode') == 7002)
              <div class="chip red lighten-1 white-text col s12">
                <center>Please login first
                <i class="close material-icons">close</i></center>
              </div>
            @elseif (Session::get('errorcode') == 7003)
              <div class="chip red lighten-1 white-text col s12">
                <center>This ticket is invalid or expired
                <i class="close material-icons">close</i></center>
              </div>
            @endif
          @endif
          <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="row">
              <div class="input-field col s12">
                <input id="ticket" name="ticket" type="text" class="validate" required>
                <label for="ticket">Ticket</label>
              </div>
            </div>
            <div class="row">
              <button class="col s12 btn btn-blue waves-effect waves-light" type="submit">LOGIN</button>
            </div>
          </form>
          @else
          @include('module.menu')
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection