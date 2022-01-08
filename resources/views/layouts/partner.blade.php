<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @foreach($lists as $list)
             <ul>
                 <li> {{$list['name']}}
                 </li>
             </ul>
                @endforeach

        </div>
    </div>
</div>