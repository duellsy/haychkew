<div class="reading-list">
<div class="input-append">
    <form action="{{ URL::to('pocket/add_link') }}" method="post">
        <input class="span10" id="url" name="url" type="text">
        <button class="btn" type="submit"><i class="icon-plus"></i> Add</button>
    </form>
</div>
@if($connected)
    @foreach($reading_list as $link)
    <div class="row-fluid bookmark-block <?php echo $link->favorite?'favorite':'not-favorite' ?>">

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
                <a class="tipsy btn btn-mini archive-link" data-id="{{ $link->item_id }}" href="#" title="Archive link"><i class="icon-ok"></i></a>
                <a class="tipsy btn btn-mini delete-link" data-id="{{ $link->item_id }}" href="#" title="Remove link"><i class="icon-remove"></i></a>
                <a class="tipsy btn btn-mini unfavorite-link" data-id="{{ $link->item_id }}" href="#" title="Un-favorite link"><i class="icon-star"></i></a>
                <a class="tipsy btn btn-mini favorite-link" data-id="{{ $link->item_id }}" href="#" title="Favorite link"><i class="icon-star-empty"></i></a>
            </div>

            @if(isset($link->has_image) AND $link->has_image == "1" AND isset( $link->image ))
            <img src="{{ $link->image->src }}" style="width: 100%; margin: 0 0 10px 10px" class="clearfix pull-right" />
            @endif

        </div>

    </div>
    <?php //var_dump($link);?>

    <hr id="hr-{{ $link->item_id }}" />
    @endforeach
@else
    <a href="{{ URL::to('settings') }}">Connect pocket account from settings page</a>
@endif
</div>
