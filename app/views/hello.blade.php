@section('content')

@include('partials.googlesearch')

@foreach($groups as $group)
    <h3>{{ $group->name }}</h3>
    <ul>
        @foreach($group->bookmarks as $bookmark)
            <li><a href="{{ $bookmark->url }}">{{ $bookmark->title }}</a></li>
        @endforeach
        <li>
    </ul>
@endforeach


@stop
