@extends("../layouts.app")
@section('content')
    <div id="content"> 
        @if(Session('logedadminrole') != 3)       
        <form action="add_admin" method="post" enctype="multipart/form-data" class="secdiv">
            @csrf
            <h5 class="text-center mb-4">Create a new Admin</h5>
            <div class="form-group mb-3">
                <label for="adrole">Select Role:</label>
                <select name="adrole" id="adrole" class="form-control">
                    <option value="2">Admin</option>
                    <option value="1">Super Admin</option>
                    <option value="3">Manager</option>
                </select>
            </div> 
            <div class="form-group mb-3">
                <label for="fnm">Full Name:</label>
                <input type="text" id="fnm" name="fnm" class="form-control">
            </div>        
            <div class="form-group mb-3">
                <label for="aemail">Email:</label>
                <input type="email" id="aemail" name="aemail" class="form-control">
            </div>        
            <div class="form-group mb-3">
                <label for="apassword">Set Password:</label>
                <input type="text" id="apassword" name="apassword" class="form-control">
            </div>        
            <div class="form-group mb-3">
                <label for="acstatus">Account Status:</label>
                <select name="acstatus" id="acstatus" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Diactivate</option>
                </select>
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Apoint This Persion</button>
            </div>
        </form>
        @endif
        <div class="secdiv">
            @if(Session('logedadminrole') == 1)
            <h5>Registerd Super Admins:</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tabledata">
                        @foreach ($sadmin as $item)
                            <tr>
                                <td scope="col">{{ $count++ }}</td>
                                <td scope="col">{{ $item['name'] }}</td>
                                <td scope="col">{{ $item['email'] }}</td>
                                <td scope="col">{{ $item['created_at'] }}</td>
                                <td scope="col">{{ $item['status'] }}</td>
                                <td scope="col"><a href="change_admin/{{ $item['id'] }}">Change</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br><br>
            @endif
            @if(Session('logedadminrole') != 3)
            <h5>Registerd Regular Admins:</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tabledata">
                        @foreach ($admin as $item)
                            <tr>
                                <td scope="col">{{ $count++ }}</td>
                                <td scope="col">{{ $item['name'] }}</td>
                                <td scope="col">{{ $item['email'] }}</td>
                                <td scope="col">{{ $item['created_at'] }}</td>
                                <td scope="col">{{ $item['status'] }}</td>
                                <td scope="col"><a href="change_admin/{{ $item['id'] }}">Change</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br><br>
            @endif
            <h5>Registerd Manager:</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tabledata">                        
                        @foreach ($manager as $item)
                            <tr>
                                <td scope="col">{{ $count++ }}</td>
                                <td scope="col">{{ $item['name'] }}</td>
                                <td scope="col">{{ $item['email'] }}</td>
                                <td scope="col">{{ $item['created_at'] }}</td>
                                <td scope="col">{{ $item['status'] }}</td>
                                <td scope="col"><a href="change_admin/{{ $item['id'] }}">Change</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
@endsection