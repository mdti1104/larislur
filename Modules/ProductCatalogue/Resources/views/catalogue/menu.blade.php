<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Kokuja -   Responsive Restaurant / Cafe / Pub Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/reset.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/plugins.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/dark-style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/color.css')}}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('catalogue/images/favicon.ico')}}">
    </head>
    <body>
        <!-- lodaer  -->
        <div class="loader-wrap">
            <div class="loader-item">
                <div class="cd-loader-layer" data-frame="25">
                    <div class="loader-layer"></div>
                </div>
                <span class="loader"></span>
            </div>
        </div>
        <!-- loader end  -->
        <!-- main start  -->
        <div id="main">
            <!-- header  -->
            @include('productcatalogue::catalogue.partials.header')

            <!--header end -->	
            <!-- wrapper  -->	
            <div id="wrapper">
                <!-- content  -->	
                <div class="content">
                    <!--  section  -->  
                    <section class="parallax-section hero-section hidden-section" data-scrollax-parent="true">
                        <div class="bg par-elem "  data-bg="{{ asset('catalogue/images/bg/12.jpg')}}" data-scrollax="properties: { translateY: '30%' }"></div>
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="section-title">
                                <h4>Special menu offers.</h4>
                                <h2>Discover Our menu</h2>
                                <div class="dots-separator fl-wrap"><span></span></div>
                            </div>
                        </div>
                        <div class="brush-dec"></div>
                    </section>
                    <!--  section  end-->  
                    <!--  section  -->   
                    <section class="small-top-padding">
                        <div class="brush-dec2 brush-dec_bottom"></div>
                        <div class="container">
                            <!--  hero-menu_header  end-->
                            <div class="hero-menu single-menu  tabs-act fl-wrap">
                                <div class="gallery_filter-button btn">Show Filters <i class="fal fa-long-arrow-down"></i></div>
                                <!--  hero-menu_header-->
                                <div class="hero-menu_header fl-wrap gth">
                                    <ul class="no-list-style">
                                        @foreach($categories as $key => $value)
                                        <li @if($categories_id == $key) class="current" @endif><a href="/catalogue/category/{{$business_id}}/{{$key}}">{{$value}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--  hero-menu_header  end-->
                                <!--  hero-menu_content   -->
                                <div class="hero-menu_content fl-wrap">
                                    <div class="tabs-container">
                                        <div class="tab">
                                            <!--tab -->
                                            <div id="tab-1" class="tab-content first-tab">
                                                <!-- hero-menu-item-->
                                                @foreach($paginator as $product)
                                                @php
                                                    $has_modifier = false;
                                                    $max_price = $product->variations->max('sell_price_inc_tax');
                                                    $min_price = $product->variations->min('sell_price_inc_tax');
                                                    if (count($product->modifier_sets) > 0) {
                                                      $product_ms = $product->modifier_sets;
                                                      $has_modifier = true;
                                                      $modifier = [];
                                                      foreach($product_ms as $key =>  $modifier_set){
                                                       foreach($modifier_set->variations as $modifiers)
                                                            $modifier[$key][$modifier_set->name] = [
                                                                 'id' => $modifiers->id,
                                                                 'name' => $modifiers->name,
                                                                ];
                                                        }
                                                    }
                                                @endphp
                                                <div class="hero-menu-item">
                                                    <a href="{{$product->image_url}}" class="hero-menu-item-img image-popup"><img src="{{$product->image_url}}" alt=""></a>
                                                    <div class="hero-menu-item-title fl-wrap">
                                                        <h6>{{$product->name}}</h6>
                                                        <span class="hero-menu-item-price">Rp. {{(number_format($max_price,0,',','.'))}}</span>
                                                        <div class="add_cart @if($has_modifier)  show-rb @endif" @if($has_modifier) data-attribute="{!! json_encode($modifier) !!}" @endif>Add To Cart</div>
                                                    </div>
                                                    <div class="hero-menu-item-details">
                                                        <p>{{$product->description}}</p>
                                                    </div>
                                                </div>
                                                 @endforeach                                                      
                                            </div>
                                                                                            
                                        </div>
                                        <!--tabs end -->
                                    </div>
                                </div>
                                {{ $paginator->links('productcatalogue::catalogue.partials.pagination') }}
                            </div>
                                
                            <div class="clearfix"></div>
                            <div class="bold-separator bold-separator_dark"><span></span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="section-bg">
                            <div class="bg"  data-bg="{{ asset('catalogue/images/bg/dec/section-bg.png')}}"></div>
                        </div>
                    </section>
                </div>
                <!-- content end  -->
                                              
            </div>
            <!-- wrapper end -->
          <!-- reservation-modal-wrap-->          
          <div class="reservation-modal-wrap">
                    <div class="reserv-overlay crm">
                        <div class="cd-reserv-overlay-layer" data-frame="25">
                            <div class="reserv-overlay-layer"></div>
                        </div>
                    </div>
                    <div class="reservation-modal-container bot-element">
                        <div class="reservation-modal-item fl-wrap">
                            <div class="close-reservation-modal crm"><i class="fal fa-times"></i></div>
                            <div class="reservation-bg"></div>
                            <div class="section-title">
                                <h4>Select Variantion And Modifiers</h4>
                                <div class="dots-separator fl-wrap"><span></span></div>
                            </div>
                            <div class="reservation-wrap">
                                <div id="reserv-message"></div>
                                <form  class="custom-form" action="#" name="reservationform" id="reservationform">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="fl-wrap">
                                                    <select name="numperson" id="persons" data-placeholder="Modifiers" class="chosen-select no-search-select">
                                                        <option data-display="Modifiers"></option>
                                                        <option value="1">1 Person</option>
                                                        <option value="2">2 People</option>
                                                        <option value="3">3 People</option>
                                                        <option value="4">4 People</option>
                                                        <option value="5">5 People</option>
                                                        <option value="Banquet">Banquet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="fl-wrap">
                                                    <select name="restime" id="resrv-time" data-placeholder="Variation" class="chosen-select no-search-select">
                                                        <option data-display="Variation">Any</option>
                                                        <option value="10:00am">10:00 am</option>
                                                        <option value="11:00am">11:00 am</option>
                                                        <option value="12:00pm">12:00 pm</option>
                                                        <option value="1:00pm">1:00 pm</option>
                                                        <option value="2:00pm">2:00 pm</option>
                                                        <option value="3:00pm">3:00 pm</option>
                                                        <option value="4:00pm">4:00 pm</option>
                                                        <option value="5:00pm">5:00 pm</option>
                                                        <option value="6:00pm">6:00 pm</option>
                                                        <option value="7:00pm">7:00 pm</option>
                                                        <option value="8:00pm">8:00 pm</option>
                                                        <option value="9:00pm">9:00 pm</option>
                                                        <option value="10:00pm">10:00 pm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn color-bg" id="reservation-submit">Checkout <i class="fal fa-long-arrow-right"></i></button>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- reservation-wrap end-->
                        </div>
                    </div>
                </div>
                <!-- reservation-modal-wrap end-->   
            <!-- cursor-->
            <div class="element">
                <div class="element-item"></div>
            </div>
            <!-- cursor end-->                                                    
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="{{ asset('catalogue/js/jquery.min.js')}}"></script>
        <script src="{{ asset('catalogue/js/plugins.js')}}"></script>
        <script src="{{ asset('catalogue/js/scripts.js')}}"></script>
        <script>
            $(document).ready(function(){
                $('.add_cart').click(function(){
                    
                })
            })
        </script>
    </body>
</html>