   <div class="header clearfix">
                        <h2>{{ Auth::user()->first_name." ".Auth::user()->last_name }}</h2>
                        <h4>Landlord</h4>
                        <img src="{{ !empty(Auth::user()->photo) ? asset('upload/landlord/'.Auth::user()->photo) : asset('upload/no_image.png') }}" alt="avatar" class="img-fluid profile-img">
                    </div>
                    <!-- Detail -->
                    <div class="detail clearfix">
                        <ul>
                            <li>
                                <a href="{{ route('landlord.dashboard') }}" class="{{ Route::currentRouteName() == 'landlord.dashboard' ? 'active' : ''}}">
                                    <i class="{{ route('landlord.dashboard') }}"></i>{{ __('Profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('landlord.properties') }}"  class="{{ Route::currentRouteName() == 'landlord.properties' || Route::currentRouteName() == 'landlord.properties.add' || Route::currentRouteName() == 'landlord.properties.edit'  ? 'active' : ''}}">
                                    <i class="flaticon-house"></i>{{ __('My Properties')}}
                                </a>
                            </li>
                            <!-- <li>
                                <a href="favorited-properties.html">
                                    <i class="flaticon-heart-shape-outline"></i>Favorited Properties
                                </a>
                            </li> -->
                            <li>
                                <a href="{{ route('landlord.booking.enquiries') }}"  class="{{ Route::currentRouteName() == 'landlord.booking.enquiries'  ? 'active' : ''}}">
                                    <i class="flaticon-file"></i>Booking Enquiries
                                </a>
                            </li>
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