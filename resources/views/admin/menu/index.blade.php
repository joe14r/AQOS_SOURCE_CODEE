@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Menu Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('menus.create') }}"><i class="fa fa-plus"></i> Create menu</a>
        </div>
    </div>
</div>

@session('success')
    <div class="alert alert-success error" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Image</th>
       <th>Name</th>
       <th>price</th>
       <th>Status</th>
       <th width="280px">Action</th>
   </tr>
   @foreach ($data as $key => $row)
    <tr>
        <td>{{ ++$i }}</td>
        <td><img src="{{ asset('storage/' . $row->image) }}" alt="Uploaded Image" width="200"></td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->price }}</td>
        <td>
          
               <label class="badge bg-success">{{ $row->status }}</label>
            
        <td>
             <a class="btn btn-info btn-sm" href="{{ route('menus.show',$row->id) }}"><i class="fa-solid fa-list"></i> Show</a>
             <a class="btn btn-primary btn-sm" href="{{ route('menus.edit',$row->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
              <form method="POST" action="{{ route('menus.destroy', $row->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
        </td>
    </tr>
 @endforeach
</table>

{!! $data->links('pagination::bootstrap-5') !!}


@endsection
