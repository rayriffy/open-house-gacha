@extends('master')

@section('title', 'Item · Listing')

@section('content')
  <div class="row">
    <div class="col l8 m6 s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Item Listing</span>
          <div class="row">
            <a class="waves-effect waves-light btn modal-trigger" href="#add">ADD</a>
          </div>
          <div class="row">
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                <tr>
                  <td>{{ $item["name"] }}</td>
                  <td>{{ $item["amount"] }}</td>
                  <td><a href="{{ route('dashboard.item.edit', ['ref' => $item["ref"]]) }}" class="btn blue-btn waves-effect waves-light">EDIT</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
  <div id="add" class="modal">
    <form action="{{ route('system.item.add') }}" method="POST" class="col s12">
    @csrf
    <div class="modal-content">
      <h4>Adding Item</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate">
          <label for="name">Item Name</label>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button href="#!" type="submit" class="modal-close waves-effect waves-green btn-flat">ADD</button>
    </div>
    </form>
  </div>
@endsection