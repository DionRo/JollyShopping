@extends('admin/master/master')

@section('content')

    <div class="statistics flex flex-center">
        <div class="total-users stat-item">
            <h4><i class="fa fa-user" aria-hidden="true"></i> Gebruikers</h4>
            <p>{{$amountUsers}}</p>
        </div>
        <div class="total-men stat-item">
            <h4><i class="fa fa-male" aria-hidden="true"></i> Mannelijke Gebruikers</h4>
            <p>{{$amountMale}}</p>
        </div>
        <div class="total-women stat-item">
            <h4><i class="fa fa-female" aria-hidden="true"></i> Vrouwelijke Gebuikers</h4>
            <p>{{$amountFemale}}</p>
        </div>
        <div class="total-views stat-item">
            <h4><i class="fa fa-eye" aria-hidden="true"></i> Product Views</h4>
            <p>{{$totalViews}}</p>
        </div>
        <div class="total-favored">
            <h4><i class="fa fa-heart" aria-hidden="true"></i> Product Favorieten</h4>
            <p>{{$totalFavored}}</p>
        </div>
    </div>
    <div class="overviews">
        <h4>Top Accessoires</h4>
        <div class="overviews-container">
            <ul class="flex">
                @for($i = 0; $i < count($accessoriesViews); $i++)
                    @if($i < 2)
                        <li class="flex">
                            <div class="overview-item align-center">
                                <img src="{{$accessoriesViews[$i]->picture}}" alt="">
                                <h5>{{$accessoriesViews[$i]->name}}</h5>
                            </div>
                            <div class="overview-item-info align-center flex flex-center flex-column">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <p>{{$accessoriesViews[$i]->views}}</p>
                            </div>
                        </li>
                    @endif
                @endfor
                @for($i = 0; $i < count($accessoriesFavored); $i++)
                    @if($i < 2)
                        <li class="flex">
                            <div class="overview-item align-center">
                                <img src="{{$accessoriesFavored[$i]->picture}}" alt="">
                                <h5>{{$accessoriesFavored[$i]->name}}</h5>
                            </div>
                            <div class="overview-item-info align-center flex flex-center flex-column">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <p>{{$accessoriesFavored[$i]->favored}}</p>
                            </div>
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
        <h4>Top Sieraden</h4>
        <div class="overviews-container">
            <ul class="flex">
                @for($i = 0; $i < count($jewerliesViews); $i++)
                    @if($i < 2)
                        <li class="flex">
                            <div class="overview-item align-center">
                                <img src="{{$jewerliesViews[$i]->picture}}" alt="">
                                <h5>{{$jewerliesViews[$i]->name}}</h5>
                            </div>
                            <div class="overview-item-info align-center flex flex-center flex-column">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <p>{{$jewerliesViews[$i]->views}}</p>
                            </div>
                        </li>
                    @endif
                @endfor
                @for($i = 0; $i < count($jewerliesFavored); $i++)
                    @if($i < 2)
                        <li class="flex">
                            <div class="overview-item align-center">
                                <img src="{{$jewerliesFavored[$i]->picture}}" alt="">
                                <h5>{{$jewerliesFavored[$i]->name}}</h5>
                            </div>
                            <div class="overview-item-info align-center flex flex-center flex-column">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <p>{{$jewerliesFavored[$i]->favored}}</p>
                            </div>
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
    </div>

@endsection