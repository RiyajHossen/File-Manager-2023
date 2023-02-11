@extends('../layouts.app')
@section('content')
    <div id="content">
        <form action="sub-category" method="post" class="secdiv">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('Error'))
                <div class="alert alert-danger">
                    {{ Session::get('Error') }}
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label for="mact">Select Main Category:</label>
                <select name="mact" id="mact" class="form-control">
                    @foreach ($mcategories as $mcat)
                        <option value="{{ $mcat['id'] }}">{{ $mcat['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sctnm">Sub Category Name:</label>
                <input type="text" name="sctnm" id="sctnm" class="form-control">
            </div>
            <div class="form-group">
                <label for="sctdesc">Category Description:</label>
                <textarea id="sctdesc" name="sctdesc" class="form-control"></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
        <div class="secdiv">
            <h4 class="mb-4">Recently created sub-categories:</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Sub-Category Name</th>
                            <th>Sub-Category Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                            if (isset($_GET['page'])) {
                                $count = $perPage * $_GET['page'] - $perPage + 1;
                            }
                        @endphp
                        @foreach ($scategories as $scat)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $scat['name'] }}</td>
                                <td>{{ $scat['description'] }}</td>
                                <td><a href="editscat/{{ $scat['id'] }}">Edit</a> <a
                                        href="sub-category/delete/{{ $scat['id'] }}">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $scategories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
