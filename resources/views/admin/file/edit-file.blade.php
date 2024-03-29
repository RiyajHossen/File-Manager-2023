@extends("../layouts.app")
@section('content')
    <div id="content">
        <form action="{{url('update_file')}}" method="post" class="secdiv">
            
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                        <label for="main_cat">Main Category:</label>
                        <select name="main_cat" id="main_cat" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($mainctgs as $mainctg)
                            <option value="{{$mainctg['id']}}" @if($mcat==$mainctg['id']) selected @endif>{{$mainctg['name']}}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                        <label for="sub_cat">Sub Category:</label>
                        <select name="sub_cat" id="sub_cat" class="form-control" required>
                            @foreach($allscats as $scat)
                            <option value="{{$scat['id']}}" @if($mcat==$scat['id']) selected @endif>{{$scat['name']}}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="fnm">File Title:</label>
                <input type="text" id="fnm" name="fnm" class="form-control" value="{{$title}}" required>
            </div>        
            <div class="form-group mb-3">
                <label for="filedet">File Description:</label>
                <textarea id="filedet" name="filedet" class="form-control">{{$description}}</textarea>
            </div>
            <div class="form-group">
            @if(Session::has('success'))
                <span class="alert-success" role="alert">
                    <strong>{{ Session('success') }}</strong>
                </span>
            @endif
            @if(Session::has('error'))
                <span class="alert-danger" role="alert">
                    <strong>{{ Session('error') }}</strong>
                </span>
            @endif
                <input type="hidden" name="fileid" value="{{$fileid}}">
                <button type="submit" class="btn btn-primary">Update File</button>
            </div>
        </form>
    </div>    
@endsection
@section('script')
<script>
    
    $(document).ready(function() {
    $('#main_cat').on('change', function() {
       var categoryID = $(this).val();
       if(categoryID) {
           $.ajax({
               url: '/getmaincat/'+categoryID,
               type: "GET",
               data : {"_token":"{{ csrf_token() }}"},
               dataType: "json",
               success:function(data)
               {
                 if(data){
                    $('#sub_cat').empty();
                    $('#sub_cat').append('<option hidden value="">Sub Category</option>'); 
                    $.each(data, function(id, sub_cat){
                        $('select[name="sub_cat"]').append('<option value="'+ sub_cat.id +'">' + sub_cat.name+ '</option>');
                    });
                }else{
                    $('#sub_cat').empty();
                }
             }
           });
       }else{
         $('#sub_cat').empty();
       }
    });
    });
    
</script>
@endsection