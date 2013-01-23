@section('content')

<div class="row">
    <div class="column span6">
        <h1>Settings</h1>

        <form method="post">
        @foreach($settings as $setting)
            <div class="row">
                <div class="column span2">
                    <label for="setting_{{ $setting->var }}" class="">{{ ucwords(str_replace('_', ' ', $setting->var)) }}</label>
                </div>
                <div class="column span10">
                    <input id="setting_{{ $setting->var }}" type="text" name="{{ $setting->var }}" value="{{ $setting->value }}" />
                </div>
            </div>
        @endforeach
            <div class="form-actions">
                <input class="btn" type="submit" value="Save" />
            </div>
        </form>

    </div>

    <div class="column span6">

        <h1>Connections</h1>

        <h3>Pocket</h3>
        <a href="{{ URL::to('pocket/connect') }}">Connect to Pocket</a>

    </div>

</div>
@stop
