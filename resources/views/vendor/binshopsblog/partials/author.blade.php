<!-- <div class="news-author"> -->
<!--     <div class="media">
        <div class="media-left">
        	<a href="#" class="media-image">
        		@if(isset($currentUser->avatar->path))
				    <img src="{{ $post->author->avatar->path }}" alt="..." class="author-image z-depth-2" alt="100x100">
				@else
				    <span><i class="fa fa-user" style="font-size: 70px" aria-hidden="true"></i></span>
				@endif

        	</a>
        </div>
        <div class="media-body">
            <div class="info">
                <div class="author item"><a href="#">{{$post->author->last_name}}</a></div>
            </div>
            <div class="position">Author</div>
            <div class="des"><p>{{$post->author->bio}}</p></div>
        </div>
    </div> -->

    
<!-- </div> -->

<div class="info">
    <div class="author item"><a href="#">{{$post->author->last_name}}</a></div>
</div>
