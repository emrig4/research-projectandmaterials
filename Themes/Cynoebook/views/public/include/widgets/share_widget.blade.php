<div class="share-widget widget col-md-12 sd380">
    <div class="title-widget">share this news</div>
    <div class="content-widget">
        <div class="socials social-widget">
        	<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="link facebook">
            	<i class="fa fa-facebook"></i>
        	</a>
        	<!-- <a href="#" class="link google"><i class="fa fa-google-plus"></i></a> -->
        	<a target="_blank" href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ url()->current() }}" class="link twitter">
            	<i class="fa fa-twitter"></i>
        	</a>
        	
	        <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&description={{ $title }}" target="_blank" class="pinterest">
	            <i class="fa fa-pinterest"></i>
	        </a>

        	<!-- <a href="#" class="link blog"><i class="fa fa-rss"></i></a> -->
        	<!-- <a href="#" class="link dribbble"><i class="fa fa-dribbble"></i></a> -->
        	<!-- <a href="#" class="link tumblr"><i class="fa fa-tumblr"></i></a> -->

        	 <a target="_blank"href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $title }}" class="linkedin">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
	        </a>
	        <a href="mailto:?subject={{$title}}&amp;body=Check out this eBook {{ url()->current() }}" >
	            <i class="fa fa-envelope"></i>
	        </a>
        </div>
    </div>
</div>  