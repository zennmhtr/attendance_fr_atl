
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>rewards</title>
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('/myhr/images/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/myhr/images/logo.png') }}" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
</head>

<body>
       <!-- preloade -->
       <div class="preload preload-container">
        <div class="preload-logo">
          <div class="spinner"></div>
        </div>
      </div>
    <!-- /preload -->
    <div class="header is-fixed">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>Hari Penuh Senyuman</h3>
            </div>
        </div>
    </div>
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">
                <ul class="menu-tabs tabs-food">
                    <li class="nav-tab active">Hari Bahagia</li>
                    <li class="nav-tab">Jejak Keberhasilan</li>
                </ul>
                <div class="content-tab pt-tab-space mb-5">
                    <div class="tab-gift-item">
                        @foreach ($data_user as $user)
                            @php
                                $tgl_lahir = new DateTime($user->tgl_lahir);
                            @endphp
                            <div class="food-box">
                                <div class="img-box">
                                    @if($user->foto_karyawan == null)
                                        <img src="{{ url('/assets/img/foto_default.jpg') }}"  alt="image">
                                    @else
                                        <img src="{{ url('/storage/'.$user->foto_karyawan) }}"  alt="image">
                                    @endif
                                    <span>&nbsp;</span>
                                </div>
                                <div class="content">
                                    <h4><a href="{{ url('/pegawai/show/'.$user->id) }}">{{ $user->name }}</a></h4>
                                    <span>{{ $tgl_lahir->format('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-gift-item-2">
                        <div class="tes-gift-box">
                            <h3>Victuals</h3>
                            <div class="swiper-container tes-gift-2 mt-5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                               <li class="name"><a href="#" class="on_surface_color fw_7"> THE TEST KITCHEN</a> </li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                               <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                               <li class="name"><a href="#" class="on_surface_color fw_7"> THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class= "mt-2 swiper-pagination dots-tes dots-food-tes"></div>
                            </div>
                        </div>

                        <div class="tes-gift-box mt-4">
                            <h3>Kitchen</h3>
                            <div class="swiper-container tes-gift-2 mt-5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                               <li class="name"><a href="#" class="on_surface_color fw_7"> THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                                <div class= "mt-2 swiper-pagination dots-tes dots-food-tes"></div>
                            </div>
                        </div>
                        <div class="tes-gift-box mt-4">
                            <h3>Restaurant</h3>
                            <div class="swiper-container tes-gift-2 mt-5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="on_surface_color fw_7"> THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="on_surface_color fw_7">THE TEST KITCHEN</a> </li>
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                                <div class= "mt-2 swiper-pagination dots-tes dots-food-tes"></div>
                            </div>
                        </div>
                        <div class="tes-gift-box mt-4">
                            <h3>Victuals</h3>
                            <div class="swiper-container tes-gift-2 mt-5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                               <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-2">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="white_color fw_5">THE TEST KITCHEN</a></li> 
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon white_color fw_4">COUPON</li> 
                                               <li class="white_color fw_4">
                                                    <i class="icon-noti white_color"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-2.jpg') }}" alt="images">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-gift-card large bg_gift-card-1">
                                            <ul class="desc">
                                                <li class="name"><a href="#" class="on_surface_color fw_7"></a> THE TEST KITCHEN</li>
                                               <li class="code success_color fw_6">R100</li> 
                                               <li class="counpon">COUPON</li> 
                                               <li>
                                                    <i class="icon-noti"></i>
                                                    Term of use
                                               </li>   
                                            </ul>
                                            <div class="img-gift">
                                                <img src="{{ url('/myhr/images/rewards/gift-1.jpg') }}" alt="images">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class= "mt-2 swiper-pagination dots-tes dots-food-tes"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            
        </div>
    </div>
    
    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>

</body>

</html>