
<div class="btn-group pull-right">
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"> -- select -- <span class="caret"></span></a>
    <ul class="dropdown-menu">
        @foreach($items as $item)
            @if(is_array($item))
                <li>
                    <a
                    @foreach($item['link'] as $attribute => $value)
                        {{$attribute}}={{$value}}
                    @endforeach
                    >{{ $item['title']  }}</a>
                </li>
            @else
                <li style="color: #31708f !important;font-weight: bold;font-size: 14px;">{{ $item  }}</li>
            @endif
        @endforeach
    </ul>
</div>

@push('css')
    <style>
        li.dropdown-submenu:hover ul{
            display: block;
            left: 100%;
        }
        .dropdown-submenu{
            position:relative;
        }

        .dropdown-submenu:hover .dropdown-menu{
            top:0;
        }
    </style>
@endpush
@push('js')
    <script>
        $(".dropdown-menu li a").click(function(){
            var selText = $(this).text();
            $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });
    </script>
@endpush
