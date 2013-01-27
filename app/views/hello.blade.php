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
        <div id="list-holder"><h4>Loading...</h4></div>
    </div>

</div>


<script>
$(document).ready(function(){
    $.ajax({
        url: '{{ URL::to('pocket/reading_list') }}'
    }).done(function(data){
        console.log(data);
        $('#list-holder').html(data);
    });
});
</script>

@stop
