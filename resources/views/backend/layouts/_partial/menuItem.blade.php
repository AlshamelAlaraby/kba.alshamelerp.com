@if(empty($subMenus))
<li class="nav-item">
    <a href="{{$link}}" class="nav-link">
        <i class="{{$iconClass}}"></i>
        <p>
            {{$title}}
        </p>
    </a>
</li>
@else
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="{{$iconClass}}"></i>
        <p>
            {{$title}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @foreach($subMenus as $m)
            <li class="nav-item">
                <a href="{{$m['link']}}" class="nav-link">
                    <i class="{{$m['iconClass']}}"></i>
                    <p>{{$m['title']}}</p>
                </a>
            </li>
        @endforeach
    </ul>
</li>
@endif
