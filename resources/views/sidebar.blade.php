<div>
    <h4>Search</h4>
    <form action="/search">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." name="search" id="search">
            <div class="input-group-append">
                <button class="btn btn-secondary py-0 px-3" type="submit"><i class="fa fa-search"></i></button>
              </div>
          </div>
    </form>
    <h4><a href="{{route('categories-index')}}"><u>Categories</u></a></h4>
    <ul class="list-unstyled">
        @foreach ($all_categories as $category)
        <li>
            <a href="{{route('category-show',['category'=>$category->id])}}"
                class="text-primary">{{$category->title}}</a>
        </li>
        @endforeach
    </ul>
</div>