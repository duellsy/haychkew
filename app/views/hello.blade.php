@section('content')

@include('partials.googlesearch')

<div class="row-fluid">
    <div class="column span6">
@foreach($groups as $group)
        <h3>{{ $group->name }}</h3>
        <ul>
            @foreach($group->bookmarks as $bookmark)
                <li><a href="{{ $bookmark->url }}">{{ $bookmark->title }}</a></li>
            @endforeach
            <li>
        </ul>
@endforeach
    </div>

    <div class="column span6">
        <h3>Pocket reading list</h3>
        @include('partials/readinglist')
    </div>

</div>

@stop
