
@extends("../layouts.app")
@section('content')
<div id="content">
    <form action="categories" method="post" class="secdiv">
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
            <input type="text" name="ctnm" id="ctnm" class="form-control">
        </div>
        <div class="form-group">
            <label for="ctdesc">Category Description</label>
            <textarea id="ctdesc" name="ctdesc" class="form-control"></textarea>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
    </form>
    <div class="secdiv">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php 
                $count=1;
                if(isset($_GET['page']))
                {
                   $count = $perPage * $_GET['page'] - $perPage + 1;
                }
                @endphp
                @foreach($categories as $category)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$category['name']}}</td>
                    <td>{{$category['description']}}</td>
                    <td><a href="editcat/{{$category['id']}}">Edit</a> <a href="category/delete/{{$category['id']}}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>    
@endsection