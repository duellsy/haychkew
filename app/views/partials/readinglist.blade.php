<div class="reading-list">
<div class="input-append">
    <form action="{{ URL::to('pocket/add_link') }}" method="post">
        <input class="span10" id="url" name="url" type="text">
        <button class="btn" type="submit"><i class="icon-plus"></i> Add</button>
    </form>
</div>
@if($connected)
    @foreach($reading_list as $link)
    <div class="row-fluid">

        <div class="column span9">
            <a target="_blank" href="{{ $link->given_url }}">
                @if(isset($link->given_title) AND $link->given_title != '')
                {{ $link->given_title }}
                @elseif(isset($link->resolved_title) AND $link->resolved_title != '')
                {{ $link->resolved_title }}
                @else
                {{ $link->resolved_url }}
                @endif
                </a><br />
            <small class="muted">added {{ date('M jS, Y h:ia', $link->time_added) }}</small>
            <p>{{ isset($link->excerpt)?$link->excerpt:'' }}</p>
        </div>

        <div class="column span3">
            <div class="btn-group pull-right">
                <a class="btn btn-mini" href="{{ URL::to('pocket/action', array('archive', $link->item_id)) }}"><i class="icon-ok"></i></a>
                <a class="btn btn-mini" href="{{ URL::to('pocket/action', array('delete', $link->item_id)) }}"><i class="icon-remove"></i></a>
                @if( $link->favorite )
                <a class="btn btn-mini" href="{{ URL::to('pocket/action', array('unfavorite', $link->item_id)) }}"><i class="icon-star"></i></a>
                @else
                <a class="btn btn-mini" href="{{ URL::to('pocket/action', array('favorite', $link->item_id)) }}"><i class="icon-star-empty"></i></a>
                @endif
            </div>

            @if(isset($link->has_image) AND $link->has_image == "1" AND isset( $link->image ))
            <img src="{{ $link->image->src }}" style="width: 100%; margin: 0 0 10px 10px" class="clearfix pull-right" />
            @endif

        </div>

    </div>
    <?php //var_dump($link);?>

    <hr />
    @endforeach
@else
    <a href="{{ URL::to('settings') }}">Connect pocket account from settings page</a>
@endif
</div>
