@extends("../layouts.app")
@section('content')
    <div id="content">
        <form action="fileupload" method="post" enctype="multipart/form-data" class="secdiv">
            
            @csrf
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="cctg">Choose a Category:</label>
                        <select name="cctg" id="cctg" class="form-control">
                            <option value="" hidden>Choose Category</option>
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
            <div class="form-group mb-3">
                <label for="fnm">File Title:</label>
                <input type="text" id="fnm" name="fnm" class="form-control" required>
            </div>        
            <div class="form-group mb-3">
                <label for="filedet">File Description:</label>
                <textarea id="filedet" name="filedet" class="form-control"></textarea>
            </div>        
            <div class="form-group mb-3">
                <label for="selfile">Select File:</label><br>
                <input type="file" id="selfile" name="selfile" required>
            </div><br>   
            <div class="form-group">
            @if(Session::has('Success'))
                <span class="alert-success" role="alert">
                    <strong>{{ Session('Success') }}</strong>
                </span><br>
            @endif
            @if(Session::has('Error'))
                <span class="alert-danger" role="alert">
                    <strong>{{ Session('Error') }}</strong>
                </span><br>
            @endif
                <button type="submit" class="btn btn-primary">Upload File</button>
            </div>
        </form>
    </div>    
@endsection
@section('script')
    <script>
        var mainUrl = "{{session('home_url')}}".split('home')[0];
        $('#cctg').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                window.location.replace(mainUrl + "/fileup/" + categoryID);                
            }
        });
    </script>
@endsection