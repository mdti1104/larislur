@inject('request', 'Illuminate\Http\Request')
<div class="row no-print">
  <div class="col-md-12">
    @if(request()->segment(2) =='view-line')
    <a href="{{ action('Restaurant\KitchenController@index')}}" title="{{ __('lang_v1.go_back') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat m-6 hidden-xs btn-sm m-5 pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
    @else
    <a href="{{ action('HomeController@index')}}" title="{{ __('lang_v1.go_back') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat m-6 hidden-xs btn-sm m-5 pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>

    @endif

    </a>
  </div>
</div>
