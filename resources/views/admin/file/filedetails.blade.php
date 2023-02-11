@extends("../layouts.app")
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
            <div>
                
                @foreach ($filedata as $file)
                    <img src="@php echo asset('img/'.pathinfo($file['originalName'], PATHINFO_EXTENSION).'.png') @endphp" alt="Preview Unavailable" width="100px" />
                    
                    <h5>{{ $file['name'] }}</h5>
                    <p>{{ $file['description'] }}</p>
                    <br>
                    <table>  
                        <tr>
                            <th>Creation Date:</th>
                            <td>{{ $file['created_at'] }}</td>
                        </tr>      
                        <tr>
                            <th>Last Update:</th>
                            <td>{{ $file['updated_at'] }}</td>
                        </tr>      
                        <tr>
                            <th>Uploader Name:</th>
                            <td>{{ $file['uploaded_by'] }}</td>
                        </tr>      
                        <tr>
                            <th>Main Category:</th>
                            <td>
                                @foreach ($mcat as $mcat)
                                {{ $mcat['name'] }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Sub Category:</th>
                            <td>
                                @foreach ($scat as $scat)
                                {{ $scat['name'] }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>
                        
                    </table>
                    <br>
                        <a href="{{url('download/'.$file['id'])}}" class="btn btn-success">Download</a>
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-3">Back</a>                        
                        {{-- <a href="{{ url()->previous() }}" class="btn btn-primary ml-3">Back</a>                         --}}
                        @endforeach
            </div>     
        </div>
    </div>    
@endsection