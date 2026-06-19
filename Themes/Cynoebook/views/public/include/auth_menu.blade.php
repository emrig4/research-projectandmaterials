
<div id="myac-hl" class="profile-icon dropdown" >
    @auth
        <a class="btn dropdown-toggle pull-left" href="#" id="my-account-hl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
           
            @if(isset($currentUser->avatar->path))
                <span><img src="{{ $currentUser->avatar->path }}" alt="..." class="rounded-circle z-depth-2" alt="100x100" style="width: 30px; height: 30px; border-radius: 50%"></span>
            @else
                <span><i class="fa fa-user" style="font-size: 20px" aria-hidden="true"></i></span>
            @endif
        </a>
    @endauth  
    <ul class="dropdown-menu" aria-labelledby="my-account-hl">
    @auth
        <li>
            <a href="{{ route('account.dashboard.index') }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.my_account')) }}</a>
        </li>
        <li>
            <a href="{{ route('user.profile.show',auth()->user()->username) }}">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.my_profile')) }}</a>
        </li>
        <li>
            <a href="{{ route('account.favorite.index') }}">
                <i class="fa fa-heart" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.my_favorite')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('account.reviews.index') }}">
                <i class="fa fa-comment" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.my_reviews')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.logout')) }}
            </a>
        </li>
        
        @if(setting('enable_ebook_upload'))
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('ebooks.upload') }}">
            
            <i class="fa fa-upload" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.upload_ebook')) }}
            </a>
        </li>
        @endif
        <li role="separator" class="divider"></li>
        @if(auth()->user()->hasRoleName('admin'))
            <li>
                <a href="{{ route('admin.dashboard.index') }}">
                
                <i class="fa fa-dashboard" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.admin_dashboard')) }}
                </a>
            </li>
        @endif
    @endauth
    </ul>
</div>
 
            