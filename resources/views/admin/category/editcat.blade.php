
@extends("../layouts.app")
@section('content')
<div id="content">
    <form action="{{ url('upcat') }}" method="post" class="secdiv">
        <h4>Edit Categorie</h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('Error'))
            <div class="alert alert-danger">
                {{Session::get('Error')}}
            </div>
        @endif
        @csrf
        <div class="form-group">
            <label for="ctnm">Category Name</label>
            <input type="text" name="ctnm" id="ctnm" value="{{ $catname }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="ctdesc">Category Description</label>
            <textarea id="ctdesc" name="ctdesc" class="form-control">{{ $catdesc }}</textarea>
        </div>
        <div class="form-group text-center">
            <input type="hidden" name="catid" value="{{ $catid }}">
            <button type="submit" class="btn btn-success">Update Category</button>
            <a href="{{ url()->previous() }}" class="btn btn-primary ml-3">Back</a>
        </div>
    </form>
</div>    
@endsection