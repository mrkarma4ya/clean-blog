<div>
    <h4 ><a href="{{route('categories-index')}}" ><u>Categories</u></a></h4>
    <ul class="list-unstyled">
        @foreach ($all_categories as $category)
        <li>
            <a href="{{route('category-show',['category'=>$category->id])}}" class="text-primary">{{$category->title}}</a>
        </li>
        @endforeach
    </ul>
</div>