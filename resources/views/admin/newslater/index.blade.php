@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">


  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Subscriber List</h5>

    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Subscriber List
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">All Delete</a>
      </h6>


      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">Email</th>
              <th class="wd-15p">Subscribiing Time</th>
              <th class="wd-20p">Action</th>

            </tr>
          </thead>
          <tbody>
            @foreach($sub as $key=>$row)
            <tr>
              <td> <input type="checkbox"> {{ $key +1 }}</td>
              <td>{{ $row->email }}</td>
              <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForhumans()  }}</td>
              <td>

                <form id="delete-form-{{ $row->id }}" method="post" action="{{ route('newslater.destroy',$row->id) }}" style="display: none">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>
                <a href="" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $row->id }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->
  </div><!-- sl-mainpanel -->
  @endsection