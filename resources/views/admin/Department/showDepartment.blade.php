@extends('index')

@section('title')
  Departments Dashboard
@endsection
@section('departmentsActive')
  class="active"
@endsection

@section('content')
    <div class="container">
        <a class='btn btn-primary' href="{{url('/admin/addDepartment')}}" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Department</a>
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead class="bg-primary" style="color:#fff" >
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Mandatory Hours</th>
                    <th>Optional Hours</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($department as $obj)
                    <tr>
                        <td>{{$obj->id}}</td>
                        <td>{{$obj->name}}</td>
                        <td>{{$obj->symbol}}</td>
                        <td>{{$obj->mandatory}}</td>
                        <td>{{$obj->optional}} </td>
                        <td>
                            <a href="{{url('/admin/updateDepartment/'.$obj->id)}}" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                            <a href="{{url('/admin/departments/'.$obj->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Department')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>	
                @endforeach       
            </tbody>
        </table>
     </div>
@endsection