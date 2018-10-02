@extends('master')

@section('title', 'Item · Editing')

@section('content')
  <div class="row">
    <div class="col l8 m6 s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Editing {{ $item["name"] }}</span>
          <div class="row">
            <form action="{{  route('system.item.update', ['ref' => $item["ref"]]) }}" method="POST" class="col s12">
              @csrf
              <input type="hidden" name="_method" value="PUT" />
              <div class="row">
                <div class="input-field col s8">
                  <input id="name" name="name" type="text" value="{{ $item["name"] }}" class="validate">
                  <label for="name">Name</label>
                </div>
                <div class="input-field col s4">
                  <input id="amount" name="amount" type="number" value="{{ $item["amount"] }}" class="validate">
                  <label for="amount">Amount</label>
                </div>
              </div>
              <div class="row">
                <button type="submit" class="col s7 btn waves-effect waves-light">EDIT</button>
                <a href="#delete" class="col s4 offset-s1 btn red waves-effect waves-light modal-trigger">DELETE</a>
              </div>
            </form>
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
  <div id="delete" class="modal">
    <div class="modal-content">
      <h4>Deleting Item</h4>
      <p>Are you sure to delete this item?<br /><div class="red-text">DELETED DATA CAN'T BE RECOVERED</div></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
      <form action="{{ route('system.item.delete', ['ref' => $item["ref"]]) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="waves-effect waves-red btn-flat">Yes</button>
      </form>
    </div>
  </div>
@endsection