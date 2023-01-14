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
                                <option value="{{ $mctg['id'] }}">{{ $mctg['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="csctg">Choose Sub Category</label>
                        <select name="csctg" id="csctg" class="form-control"></select>
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
                            $count = 1 
                            @endphp
                            @foreach ($files as $file)
                                <tr>
                                    <td scope="col">{{ $count++ }}</td>
                                    <td scope="col"><a href="filedetails/{{ $file['id'] }}">{{ $file['name'] }}</a></td>
                                    <td scope="col">{{ $file['created_at'] }}</td>
                                    <td scope="col">{{ $file['uploaded_by'] }}</td>
                                    <td scope="col"><a href="edit-file/{{ $file['id'] }}">Edit</a> <a href="delete-file/{{ $file['id'] }}">Delete</a></td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    {{ $files->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#cctg').on('change', function() {
                var categoryID = $(this).val();
                if (categoryID) {

                    $.ajax({
                        url: 'getfile/' + categoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#tabledata').empty();
                                $('#csctg').append('<option value="0" hidden>Sub Category</option>');
                                var count = 1;
                                $.each(data, function(id, csctg) {
                                    $('#tabledata').append('<tr><th scope="row">' +
                                        count++ + '</th><td><a href="filedetails/'+csctg.id+'">' +
                                        csctg.name + '</a></td><td>' +
                                        csctg.created_at.substring(0, 19).slice(0, 10) + ' ' + csctg.created_at.substring(0, 19).slice(11, 19) + '</td><td>' + csctg.uploaded_by +
                                        '</td><td><a href="edit-file/' + csctg.id +
                                        '">Edit</a> <a href="delete-file/' + csctg
                                        .id + '">Delete</a></td></tr>');
                                });
                            } else {
                                $('#csctg').empty();
                            }
                        }
                    });
                    $.ajax({
                        url: 'getmaincat/' + categoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#csctg').empty();
                                $('#csctg').append('<option value="0">All File</option>'); 
                                $.each(data, function(id, csctg) {
                                    $('select[name="csctg"]').append('<option value="' +
                                        csctg.id + '">' + csctg.name + '</option>');
                                });
                            } else {
                                $('#csctg').empty();
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#csctg').on('change', function() {
                var mainCtg=document.getElementById('cctg').value;
                var subCtg = $(this).val();
                if (subCtg) {

                    $.ajax({
                        url: 'filebysctg/'+mainCtg+'/'+subCtg,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#tabledata').empty();
                                $('#csctg').append('<option hidden>All File</option>');
                                var count = 1;
                                $.each(data, function(id, csctg) {
                                    $('#tabledata').append('<tr><th scope="row">' +
                                        count++ + '</th><td><a href="filedetails/'+csctg.id+'">' +
                                        csctg.name + '</a></td><td>' +
                                            csctg.created_at.substring(0, 19).slice(0, 10) + ' ' + csctg.created_at.substring(0, 19).slice(11, 19) +
                                        '</td><td>' + csctg.uploaded_by +
                                        '</td><td><a href="edit-file/' + csctg.id +
                                        '">Edit</a> <a href="delete-file/' + csctg
                                        .id + '">Delete</a></td></tr>');
                                });
                            } 
                        }
                    });
                }
            });
        });
    </script>
@endsection
