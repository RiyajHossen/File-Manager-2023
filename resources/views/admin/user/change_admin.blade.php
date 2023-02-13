@extends("../layouts.app")
@section('content')
    <div id="content">        
        <form action="{{url('up_admin')}}" method="post" class="secdiv">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
            @csrf
            <h5 class="text-center mb-4">Create a new Admin</h5>
            <div class="form-group mb-3">
                <label for="adrole">Select Role:</label>
                <select name="adrole" id="adrole" class="form-control">
                    <option value="2">Admin</option>
                    <option value="1" @php if($role==1){echo 'selected';} @endphp>Super Admin</option>
                    <option value="3" @php if($role==3){echo 'selected';} @endphp>Manager</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="fnm">Full Name:</label>
                <input type="text" id="fnm" name="fnm" class="form-control" value="{{$name}}" required>
            </div>        
            <div class="form-group mb-3">
                <label for="aemail">Email:</label>
                <input type="email" id="aemail" name="aemail" class="form-control" value="{{$email}}" required>
            </div>        
            <div class="form-group mb-3">
                <label for="apassword">Set Password:</label>
                <input type="text" id="apassword" name="apassword" class="form-control">
            </div>        
            <div class="form-group mb-3">
                <label for="acstatus">Account Status:</label>
                <select name="acstatus" id="acstatus" class="form-control">
                    <option value="1">Active</option>
                    <option value="0" @php if($status==0){echo 'selected';} @endphp>Diactivate</option>
                </select>
            </div> 
            <div class="form-group">
                <input type="hidden" name="adminid" value="{{$id}}">
                <button type="submit" class="btn btn-primary">Update Information</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary ml-3">Back</a>
            </div> 
        </form>        
    </div>    
@endsection