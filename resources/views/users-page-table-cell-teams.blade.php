<div>
     @php
        // --- Standard Styling ---, please componetize me
        $toggle_reported = "
        text-xs whitespace-no-wrap
        py-0 px-1 mr-1
        border border-gray-700 rounded
        w-32
        ";

        $toggle_reported_css_picked = "text-gray-700";
        $toggle_reported_css_notpicked = "text-gray-200";
        $isPrimary_css = 'bg-blue-100';
        $isSecondary_css = '';

        $isAltPrimary_css = 'text-bold';
        $isAltSecondary_css = '';
        #dd($objUser->ownedTeams()->get());
    @endphp

    @foreach ($objUser->ownedTeams()->get() as $objTeam)
        @php
        $emphasis_css = $isPrimary_css;
        $altEmphasis_css = $objTeam->personal_team ?  $isAltPrimary_css : $isAltSecondary_css;

        @endphp
        <span class="{{$toggle_reported}} {{$toggle_reported_css_picked}} {{$emphasis_css}} {{$altEmphasis_css}}">{{$objTeam->name}}</span>
    @endforeach
     @foreach ($objUser->teams as $objTeam)
        @php
        $emphasis_css = $isSecondary_css;
        $altEmphasis_css = $isAltSecondary_css;
        @endphp
        <span class="{{$toggle_reported}} {{$toggle_reported_css_picked}} {{$emphasis_css}} {{$altEmphasis_css}}">{{$objTeam->name}}</span>
    @endforeach
</div>
