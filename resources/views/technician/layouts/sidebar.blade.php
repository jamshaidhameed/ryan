   <div class="header clearfix">
    <h2>{{ Auth::user()->first_name." ".Auth::user()->last_name }}</h2>
    <h4>Technician</h4>
    <img src="{{ !empty(Auth::user()->photo) ? asset('upload/landlord/'.Auth::user()->photo) : asset('upload/no_image.png') }}" alt="avatar" class="img-fluid profile-img">
</div>
<!-- Detail -->
<div class="detail clearfix">
    <ul>
        <li>
            <a href="{{ route('technision.dashboard') }}" class="{{ Route::currentRouteName() == 'technision.dashboard' ? 'active' : ''}}">
                <i class="{{ route('technision.dashboard') }}"></i>{{ __('Profile')}}
            </a>
        </li>
        <li>
            <a href="{{ route('technision.issue.tickets') }}"  class="{{ Route::currentRouteName() == 'technision.issue.tickets' || Route::currentRouteName() == 'technision.issue.tickets' || Route::currentRouteName() == 'technision.issue.ticket.edit'  ? 'active' : ''}}">
                <i class="flaticon-house"></i>{{ __('Issue Tickets')}}
            </a>
        </li>
        <!-- <li>
            <a href="favorited-properties.html">
                <i class="flaticon-heart-shape-outline"></i>Favorited Properties
            </a>
        </li> -->
       
        <li>
            <a href="change-password.html">
                <i class="flaticon-locked-padlock"></i>Change Password
            </a>
        </li>
        <li>
            <a href="index.html" class="border-bto2">
                <i class="flaticon-logout"></i>Log Out
            </a>
        </li>
    </ul>
</div>