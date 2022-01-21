<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Restabook - Responsive Restaurant / Cafe / Pub Template</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/reset.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/plugins.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/dark-style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('catalogue/css/color.css')}}">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
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
                    <div class="bg par-elem " data-bg="images/bg/17.jpg"
                        data-scrollax="properties: { translateY: '30%' }"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="section-title">
                            <h4>Order food with home delivery</h4>
                            <h2>Your Cart</h2>
                            <div class="dots-separator fl-wrap"><span></span></div>
                        </div>
                    </div>
                    <div class="hero-section-scroll">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                    <div class="brush-dec"></div>
                </section>
                <!--  section  end-->
                <!--  section  -->
                <section class="hidden-section">
                    <div class="container">
                        <form action="/success" method="get">

                            <!-- CHECKOUT TABLE -->
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="cart-title">Your cart <span>3 items</span></h4>
                                    <table class="table table-border checkout-table">
                                        <tbody>
                                            <tr>
                                                <th class="hidden-xs">Item</th>
                                                <th>Description</th>
                                                <th class="hidden-xs">Price</th>
                                                <th>Count</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td class="hidden-xs">
                                                    <a href="#"><img src="images/menu/1.jpg" alt="" class="respimg"></a>
                                                </td>
                                                <td>
                                                    <h5 class="product-name">Grilled Steaks</h5>
                                                </td>
                                                <td class="hidden-xs">
                                                    <h5 class="order-money">$45.00</h5>
                                                </td>
                                                <td>
                                                    <input type="number" name="cartin1" value="1" max="50" min="1"
                                                        class="order-count">
                                                </td>
                                                <td>
                                                    <h5 class="order-money">$45.00</h5>
                                                </td>
                                                <td class="pr-remove">
                                                    <a href="#" title="Remove"><i class="fal fa-times"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="hidden-xs">
                                                    <a href="#"><img src="images/menu/2.jpg" alt="" class="respimg"></a>
                                                </td>
                                                <td>
                                                    <h5 class="product-name">Cripsy Lobster & Shrimp Bites</h5>
                                                </td>
                                                <td class="hidden-xs">
                                                    <h5 class="product-title order-money">$22.00</h5>
                                                </td>
                                                <td>
                                                    <input type="number" name="cartin2" value="2" max="50" min="1"
                                                        class="order-count">
                                                </td>
                                                <td>
                                                    <h5 class="order-money">$22.00</h5>
                                                </td>
                                                <td class="pr-remove">
                                                    <a href="#" title="Remove"><i class="fal fa-times"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="hidden-xs">
                                                    <a href="#"><img src="images/menu/3.jpg" alt="" class="respimg"></a>
                                                </td>
                                                <td>
                                                    <h5 class="product-name">Chicken tortilla soup</h5>
                                                </td>
                                                <td class="hidden-xs">
                                                    <h5 class="product-title order-money">$37.00</h5>
                                                </td>
                                                <td>
                                                    <input type="number" name="cartin3" value="1" max="50" min="1"
                                                        class="order-count">
                                                </td>
                                                <td>
                                                    <h5 class="order-money">$37.00</h5>
                                                </td>
                                                <td class="pr-remove">
                                                    <a href="#" title="Remove"><i class="fal fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-md-4">
                                    <!-- CART TOTALS  -->
                                    <div class="cart-totals dark-bg fl-wrap">
                                        <h3>Cart totals</h3>
                                        <table class="total-table">
                                            <tbody>
                                                <tr>
                                                    <th>Cart Subtotal:</th>
                                                    <td>$240.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Total:</th>
                                                    <td>$12.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$252.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="submit" class="cart-totals_btn color-bg">Proceed to
                                            Checkout</button>
                                    </div>
                                    <!-- /CART TOTALS  -->
                                </div>
                            </div>

                            <!-- /CHECKOUT TABLE -->
                        </form>

                    </div>
                    <div class="section-bg">
                        <div class="bg" data-bg="images/bg/dec/section-bg.png"></div>
                    </div>
                </section>
                <!--  section end  -->
                <div class="brush-dec2 brush-dec_bottom"></div>
            </div>
            <!-- content end  -->
            <!-- footer -->
            <div class="height-emulator fl-wrap"></div>
            <footer class="fl-wrap dark-bg fixed-footer">
                <div class="container">
                    <div class="footer-top fl-wrap">
                        <a href="index.html" class="footer-logo"><img src="images/logo2.png" alt=""></a>
                        <div class="lang-wrap"><a href="#" class="act-lang">En</a><span>/</span><a href="#">Fr</a></div>
                        <div class="footer-social">
                            <span class="footer-social-title">Follow us :</span>
                            <ul>
                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer-widget-wrap -->
                    <div class="footer-widget-wrap fl-wrap">
                        <div class="row">
                            <!-- footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget">
                                    <div class="footer-widget-title">About us</div>
                                    <div class="footer-widget-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Eaque ipsa quae ab illo
                                            inventore veritatis et quasi architecto. </p>
                                        <a href="about.html" class="footer-widget-content-link">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget  end-->
                            <!-- footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget">
                                    <div class="footer-widget-title">Contact info </div>
                                    <div class="footer-widget-content">
                                        <div class="footer-contacts footer-box fl-wrap">
                                            <ul>
                                                <li><span>Call :</span><a href="#">+489756412322</a> , <a
                                                        href="#">+56897456123</a></li>
                                                <li><span>Write :</span><a href="#">yourmail@domain.com</a></li>
                                                <li><span>Find us : </span><a href="#">USA 27TH Brooklyn NY</a></li>
                                            </ul>
                                        </div>
                                        <a href="contacts.html" class="footer-widget-content-link">Get in Touch</a>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget  end-->
                            <!-- footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget">
                                    <div class="footer-widget-title">Subscribe</div>
                                    <div class="footer-widget-content">
                                        <div class="subcribe-form fl-wrap">
                                            <p>Want to be notified when we launch a new template or an udpate. Just sign
                                                up and we'll send you a notification by email.</p>
                                            <form id="subscribe" class="fl-wrap">
                                                <input class="enteremail" name="email" id="subscribe-email"
                                                    placeholder="Your Email" spellcheck="false" type="text">
                                                <button type="submit" id="subscribe-button"
                                                    class="subscribe-button color-bg">Send </button>
                                                <label for="subscribe-email" class="subscribe-message"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget  end-->
                        </div>
                    </div>
                    <!-- footer-widget-wrap end-->
                    <div class="footer-bottom fl-wrap">
                        <div class="copyright">&#169; Restabook 2020 . All rights reserved. </div>
                        <div class="to-top"><span>Back To Top </span><i class="fal fa-angle-double-up"></i></div>
                    </div>
                </div>
            </footer>
            <!-- footer end-->
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
                        <h4>Don't forget to book a table</h4>
                        <h2>Table Reservations</h2>
                        <div class="dots-separator fl-wrap"><span></span></div>
                    </div>
                    <div class="reservation-wrap">
                        <div id="reserv-message"></div>
                        <form class="custom-form" action="http://restabook.kwst.net/dark/php/reservation.php"
                            name="reservationform" id="reservationform">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" placeholder="Your Name *" value="" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" id="email" placeholder="Email Address *"
                                            value="" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" id="phone" placeholder="Phone *" value="" />
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="fl-wrap">
                                            <select name="numperson" id="persons" data-placeholder="Persons"
                                                class="chosen-select no-search-select">
                                                <option data-display="Persons">Any</option>
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
                                        <div class="date-container2 fl-wrap">
                                            <input type="text" placeholder="Date" id="res_date" name="resdate"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="fl-wrap">
                                            <select name="restime" id="resrv-time" data-placeholder="Time"
                                                class="chosen-select no-search-select">
                                                <option data-display="Time">Any</option>
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
                                <textarea name="comments" id="comments" cols="30" rows="3"
                                    placeholder="Your Message:"></textarea>
                                <div class="clearfix"></div>
                                <button class="btn color-bg" id="reservation-submit">Reserve Table <i
                                        class="fal fa-long-arrow-right"></i></button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js"></script>

    <script src="{{ asset('js/cesta-feira.min.js')}}"></script>
</body>

</html>