@section('content')

@include('partials.googlesearch')

<div class="row">
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
        <div class="reading-list">
        @foreach($reading_list->list as $link)
            <div class="clearfix">
                <a href="{{ $link->given_url }}">{{ $link->resolved_title }}</a><br />
                <small class="muted">added {{ date('M jS, Y h:ia', $link->time_added) }}</small>
                @if($link->has_image)
                <img src="{{ $link->image->src }}" style="width: 150px; margin: 0 0 10px 10px" class="clearfix pull-right" />
                @endif
                <p>{{ $link->excerpt }}</p>
                <hr />
            </div>
        @endforeach
        </div>
    </div>

</div>

@stop
