@extends('../layouts.app')
@section('content')
    <div id="content">
        <div class="secdiv">
            @if(Session::has('Success'))
                <span class="alert-success" role="alert">
                    <strong>{{ Session('Success') }}</strong>
                </span>
            @endif
            @if(Session::has('Error'))
                <span class="alert-danger" role="alert">
                    <strong>{{ Session('Error') }}</strong>
                </span>
            @endif            
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="cctg">Choose a Category:</label>
                        <select name="cctg" id="cctg" class="form-control">
                            <option value="" hidden>Choose Category</option>
                            <option value="0">All File</option>
                            @foreach ($mcats as $mctg)
                                <option value="{{ $mctg['id'] }}"
                                    @php if(isset($mcat)){if($mcat==$mctg['id']){ echo 'selected';} } @endphp>
                                    {{ $mctg['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="csctg">Choose Sub Category:</label>
                        <select name="csctg" id="csctg" class="form-control">
                            <option value="0">All File</option>
                            @isset($scats)
                                @foreach ($scats as $sctg)
                                    <option value="{{ $sctg['id'] }}"
                                        @php if(isset($scat)){if($scat==$sctg['id']){ echo 'selected';} } @endphp>
                                        {{ $sctg['name'] }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="displayfiles">
                <div class="table-responsive">
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
                                    <td scope="col"><a href="{{ url('filedetails/'.$file->id) }}">
                                        <img src="@php echo asset('img/'.pathinfo($file->originalName, PATHINFO_EXTENSION).'.png') @endphp" alt="?" width="30px" /> {{ $file->name }}</a>
                                    </td>
                                    <td scope="col">{{ $file->created_at }}</td>
                                    <td scope="col">{{ $file->uploaded_by }}</td>
                                    <td scope="col"><a href="{{url('edit-file/'.$file->id) }}">Edit</a> <a
                                            href="file/delete/{{ $file->id }}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $files->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var currentUrl = window.location.origin;
        $('#cctg').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                if (categoryID == 0) {
                    window.location.replace(currentUrl + "/file/");
                } else {
                    window.location.replace(currentUrl + "/file/" + categoryID);
                }
            }
        });
        $('#csctg').on('change', function() {
            var mainCtg = document.getElementById('cctg').value;
            var subCtg = $(this).val();
            if (subCtg) {
                if (subCtg == 0) {
                    window.location.replace(currentUrl + "/file/" + mainCtg);
                } else {
                    window.location.replace(currentUrl + "/file/" + mainCtg + "/" + subCtg);
                }
            }
        });
    </script>
@endsection
