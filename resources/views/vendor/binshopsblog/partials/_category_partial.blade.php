@foreach($category_tree as $category)
    @php $trans =  null; @endphp
    @if($trans != null)
        <li class="category-item-wrapper">
            @php $nameChain = $nameChain .'/'. $trans->slug @endphp

            <a href="{{route("binshopsblog.view_category",[$locale, $nameChain ])}}">
                 <span class="category-item" value='{{$category->category_id}}'>
        {{$trans->category_name}}

                     @if( count($category->siblings) > 0)
                         <ul>
                 @include("binshopsblog::partials._category_partial", [
    'category_tree' => $category->siblings,
    'name_chain' => $nameChain
    ])
                 </ul>
                     @endif
                 </span>
            </a>
        </li>
    @endif
@endforeach
