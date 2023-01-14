@extends("../layouts.app")
@section('content')
    <div id="content">
        <form action="{{ url('upscat') }}" method="post" class="secdiv">
            @csrf
            <h4>Edit Sub Categorie</h4>
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
            <div class="form-group">
                <label for="mact">Select Main Category:</label>
                <select name="mact" id="mact" class="form-control">
                    @foreach($mcategories as $mcat)
                    <option value="{{$mcat['id']}}" @php if($mcat['id']==$scatmcat){echo 'selected';} @endphp>{{$mcat['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sctnm">Sub Category Name:</label>
                <input type="text" value="{{ $scatnm }}" name="sctnm" id="sctnm" class="form-control">
            </div>
            <div class="form-group">
                <label for="sctdesc">Category Description:</label>
                <textarea id="sctdesc" name="sctdesc" class="form-control">{{$scatdesc}}</textarea>
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="scatid" value="{{ $scatid }}">
                <button type="submit" class="btn btn-success">Update Sub Category</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary ml-3">Back</a>
            </div>
        </form>
    </div>
@endsection