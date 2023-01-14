@extends('layouts.app')
@section('content')
<div id="content">
    <div class="secdiv">        
        <div class="table-responsive">
        @isset($files)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Upload Date</th>
                    <th scope="col">Upload By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tabledata">        
        @foreach ($files as $file)
            <tr>
                <td scope="col"><a href="{{ url('filedetails/'.$file->id) }}">
                    <img src="@php echo asset('img/'.pathinfo($file->originalName, PATHINFO_EXTENSION).'.png') @endphp" alt="?" width="30px" /> {{ $file->name }}</a>
                </td>
                <td scope="col">{{ $file->created_at }}</td>
                <td scope="col">{{ $file->uploaded_by }}</td>
                <td scope="col"><a href="edit-file/{{ $file->id }}">Edit</a> <a
                        href="delete-file/{{ $file->id }}">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
        @endisset
        </div>
    </div>
</div>    
@endsection