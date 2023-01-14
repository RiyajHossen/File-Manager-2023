@extends("../layouts.app")
@section('content')
    <div id="content">
        <div class="secdiv">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="selsctg/{{ $category['id'] }}" class="text-decoration-none">
                        <div class="card p-3  m-2">
                            <h5 class="text-center">{{ $category['name'] }}</h5>
                            <p>{{ $category['description'] }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>                
        </div>
    </div>
@endsection