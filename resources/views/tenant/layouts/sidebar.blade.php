   <div class="header clearfix">
                        <h2>{{ Auth::user()->first_name." ".Auth::user()->last_name }}</h2>
                        <h4>Tenant</h4>
                        <img src="{{ !empty(Auth::user()->photo) ? asset('upload/tenant/'.Auth::user()->photo) : asset('upload/no_image.png') }}" alt="avatar" class="img-fluid profile-img">
                    </div>
                    <!-- Detail -->
                    <div class="detail clearfix">
                        <ul>
                            <li>
                                <a href="{{ route('tenant.dashboard') }}" class="{{ Route::currentRouteName() == 'tenant.dashboard' ? 'active' : ''}}">
                                    <i class="{{ route('tenant.dashboard') }}"></i>{{ __('titles.profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tenant.booking.enquiries') }}"  class="{{ Route::currentRouteName() == 'tenant.booking.enquiries' ? 'active' : ''}}">
                                    <i class="flaticon-house"></i>{{ __('titles.booked_properties')}}
                                </a>
                            </li>
                            <!-- <li>
                                <a href="favorited-properties.html">
                                    <i class="flaticon-heart-shape-outline"></i>Favorited Properties
                                </a>
                            </li> -->
                           
                            <li>
                                <a href="{{ route('tenant.change.password') }}"   class="{{ Route::currentRouteName() == 'tenant.change.password' ? 'active' : ''}}">
                                    <i class="flaticon-locked-padlock"></i>{{ __('titles.change_password') }}
                                </a>
                            </li>
                            <!-- <li>
                                <a href="index.html" class="border-bto2">
                                    <i class="flaticon-logout"></i>Log Out
                                </a>
                            </li> -->
                        </ul>
                    </div>