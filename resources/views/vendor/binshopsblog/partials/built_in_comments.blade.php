<div class="news-comment">
    <div class="news-comment-title underline">Comments</div>
    <ul class="comment-list list-unstyled">
        @forelse($comments as $comment)
            <li class="media">
                <div class="list-item">
                    <div class="media-left">
                        <!-- <a href="#" class="media-image"><img src="assets/images/people-avatar-7.png" alt=""></a> -->
                    </div>
                    <div class="media-body">
                        <div class="pull-left">
                            <div class="info">
                                <div class="reader item"><a href="#"> {{$comment->author() }} </a></div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="reply-comment reply-1">REPLY</div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="time">{{$comment->created_at->diffForHumans()}}</div>
                        <div class="des">
                            <p class="card-text">{!! nl2br(e($comment->comment))!!}</p>
                        </div>
                    </div>
                </div>
                <div class="comment-box media merge-1" style="display: none;">
                    <div class="list-item">
                        <div class="media-body">
                            <form action="#" class="bg-w-form comment-form">
                                <div class="form-group"><textarea placeholder="Your comment here..." class="form-control form-input"></textarea></div>
                            </form>
                            <div class="media-submit"><span class="input-group-btn"><button type="submit" class="btn btn-green btn-submit"><span>Submit</span></button></span></div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <div class='alert alert-info'>No comments yet! Why don't you be the first?</div>
        @endforelse
    </ul>

    @if(count($comments)> config("binshopsblog.comments.max_num_of_comments_to_show",500) - 1)
    <p>
        <em>
            Only the first {{config("binshopsblog.comments.max_num_of_comments_to_show",500)}} comments are shown.
        </em>
    </p>
    @endif
</div>




