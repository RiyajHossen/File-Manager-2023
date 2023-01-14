@extends('../layouts.app')
@section('content')
    <div id="content">
        <div class="secdiv">
            <h4>Set Permissions</h4>
            @if(Session::has('Scuccess'))
                <div class="alert alert-success">
                    {{Session::get('Scuccess')}}
                </div>
            @endif
            @if(Session::has('Error'))
                <div class="alert alert-danger">
                    {{Session::get('Error')}}
                </div>
            @endif
            <form action="{{ url('uppermission') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Regular Admin</th>
                                <th>Manager</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- File Permissions --}}
                            <tr>
                                <th>File Add</th>
                                <td><input name="file_add_a" type="checkbox" @php if($apermissions['file_add']==1){echo "checked";} @endphp></td>
                                <td><input name="file_add_m" type="checkbox" @php if($mpermissions['file_add']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <th>File Edit</th>
                                <td><input name="file_edit_a" type="checkbox" @php if($apermissions['file_edit']==1){echo "checked";} @endphp></td>
                                <td><input name="file_edit_m" type="checkbox" @php if($mpermissions['file_edit']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <th>File Delete</th>
                                <td><input name="file_delete_a" type="checkbox" @php if($apermissions['file_delete']==1){echo "checked";} @endphp></td>
                                <td><input name="file_delete_m" type="checkbox" @php if($mpermissions['file_delete']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <th>File Download</th>
                                <td><input name="file_download_a" type="checkbox" @php if($apermissions['file_download']==1){echo "checked";} @endphp></td>
                                <td><input name="file_download_m" type="checkbox" @php if($mpermissions['file_download']==1){echo "checked";} @endphp></td>
                            </tr>
                            {{-- Category --}}
                            <tr>
                                <th>Category Add</th>
                                <td><input name="category_add_a" type="checkbox" @php if($apermissions['cat_add']==1){echo "checked";} @endphp></td>
                                <td><input name="category_add_m" type="checkbox" @php if($mpermissions['cat_add']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <th>Category Edit</th>
                                <td><input name="category_edit_a" type="checkbox" @php if($apermissions['cat_edit']==1){echo "checked";} @endphp></td>
                                <td><input name="category_edit_m" type="checkbox" @php if($mpermissions['cat_edit']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <th>Category Delete</th>
                                <td><input name="category_delete_a" type="checkbox" @php if($apermissions['cat_delete']==1){echo "checked";} @endphp></td>
                                <td><input name="category_delete_m" type="checkbox" @php if($mpermissions['cat_delete']==1){echo "checked";} @endphp></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" name="submit" value="Admin" class="btn btn-success">Update</button></td>
                                <td><button type="submit" name="submit" value="Manager" class="btn btn-success">Update</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>            
                
            </form>
        </div>
    </div>
@endsection
