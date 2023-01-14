@extends('layouts.app')
@section('content')
<div id="content">
    <div id="overview" class="secdiv"> 
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-success">
                <h3 class="h1">{{$nfile}}</h3>
                <h3>Files</h3>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-danger">
                <h3 class="h1">{{$sadmin}}</h3>
                <h3>Super Admin</h3>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-info">
                <h3 class="h1">{{$admin}}</h3>
                <h3>Admin</h3>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-warning">
                <h3 class="h1">{{$manager}}</h3>
                <h3>Manager</h3>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-primary">
                <h3 class="h1">{{$categorie}}</h3>
                <h3>Category</h3>
            </div>
        </div>
        <div class=" col-12 col-sm-6 col-md-4">
            <div class="ovitem bg-secondary">
                <h3 class="h1">{{$scategorie}}</h3>
                <h3>Sub Category</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive secdiv">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Upload Date</th>
                    <th scope="col">Upload By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tabledata">
                @php 
                $count=1;
                if(isset($_GET['page']))
                {
                   $count = $perPage * $_GET['page'] - $perPage + 1;
                }
                @endphp
                @foreach ($files as $file)
                    <tr>
                        <td scope="col">{{ $count++ }}</td>
                        <td scope="col"><a href="{{ url('filedetails/'.$file['id']) }}">
                            <img src="@php echo asset('img/'.pathinfo($file->originalName, PATHINFO_EXTENSION).'.png') @endphp" alt="?" width="30px" /> {{ $file->name }}</a>
                        </td>
                        <td scope="col">{{ $file['created_at'] }}</td>
                        <td scope="col">{{ $file->uploaded_by }}</td>
                        <td scope="col"><a href="file/edit-file/{{ $file->id }}">Edit</a> <a
                                href="file/delete/{{ $file['id'] }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $files->links('pagination::bootstrap-5') }} --}}
    </div>
</div>    
@endsection
