@extends("../layouts.app")
@section('content')
    <div id="content">        
        <div class="secdiv">
            <div class="text-center">
                <img src="{{asset('img/user.jpg')}}" alt="Profile Picture unavailable" style="width:150px;border-radius:50%;">
                <h5>Hello! {{session('logedadmin')}}.</h5>
                <h6>@php 
                if(session('logedadminrole')==1){
                    echo "Super Admin";
                }else if(session('logedadminrole')==2){
                    echo "Admin";                    
                }else if(session('logedadminrole')==3){
                    echo "Manager";
                }
                @endphp</h6>
                <p>Welcome to your profile.</p>
            </div>
            <form action="uppass" method="post">
                @csrf
                <h5 class="mb-4 mt-5">Change Your Password:</h5> 
                @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif 
                <div class="form-group mb-3">
                    <label for="cpass">Current Password:</label>
                    <input type="text" id="cpass" name="cpass" class="form-control">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                </div>       
                <div class="form-group mb-3">
                    <label for="npass">New Password:</label>
                    <input type="text" id="npass" name="npass" class="form-control">
                </div>       
                <div class="form-group mb-3">
                    <label for="cnpass">Confirm New Password:</label>
                    <input type="text" id="cnpass" name="cnpass" class="form-control">
                    @if(Session::has('mfail'))
                        <div class="alert alert-danger">
                            {{Session::get('mfail')}}
                        </div>
                    @endif
                </div>       
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                    
                </div>
                
            </form>
        </div>
    </div>    
    
@endsection

