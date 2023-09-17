<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
    @foreach($siteLocales as $localeKey => $localeName)
        <li class="nav-item">
            <a class="nav-link {{$loop->iteration==1?'active':''}}" data-toggle="pill" href="#tab-{{$loop->iteration}}" role="tab" aria-controls="tab-{{$loop->iteration}}" aria-selected="true">{{$localeName}}</a>
        </li>
    @endforeach
</ul>
