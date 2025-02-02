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
                                    <i class="{{ route('landlord.dashboard') }}"></i>{{ __('titles.profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('landlord.properties') }}"  class="{{ Route::currentRouteName() == 'landlord.properties' || Route::currentRouteName() == 'landlord.properties.add' || Route::currentRouteName() == 'landlord.properties.edit'  ? 'active' : ''}}">
                                    <i class="flaticon-house"></i>{{ __('titles.my_properties')}}
                                </a>
                            </li>
                            <!-- <li>
                                <a href="favorited-properties.html">
                                    <i class="flaticon-heart-shape-outline"></i>Favorited Properties
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="{{ route('landlord.booked.properties') }}"  class="{{ Route::currentRouteName() == 'landlord.booked.properties'  ? 'active' : ''}}">
                                    <i class="flaticon-file"></i>Booked Properties
                                </a>
                            </li> -->
                            <li>
                                <a href="{{ route('landlord.password.change') }}" class="{{ Route::currentRouteName() == 'landlord.password.change'  ? 'active' : ''}}">
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