@extends('layouts.frontend')

@section('content')
<div class="homepage_wrapper">
    <div class="homepage_content">
        <div class="webhippocrates_logo"></div>
        <h2>Hello. We are webhippocrates.</h2>
        <h3>We will connect you with the best doctors around the world at just one click.</h3>
        <a class="discover_button" data-scroll-nav='0' href="#discover"></a>
        <a class="view_video" data-scroll-nav='1' href="#video">Watch Video</a>
        <p class="discover">discover more</p>
        <div class="discover_icon"></div>
        <div class="clear"></div>
        <div class="blue_arrow"></div>
    </div>
    <div class="content_white" data-scroll-index='0'>
        <h2  data-scroll-reveal="enter from the bottom after 0.2s">We can offer you:</h2>
        <div class="content_white_wrapper">
            <div class="first_column" data-scroll-reveal="enter from the right after 0.4s">
                <div class="clock_image"></div>
                <div class="column_content">
                    <h3>Fast-diagnostic services</h3>
                    <p>We have a 48 hours-diagnostic policy, which guarantees a fast response to your concerns.</p>
                </div>
                <div class="clear"></div> 
            </div>
            <div class="second_column" data-scroll-reveal="enter from the top after 0.4s">
                <div class="glass_image"></div>
                <div class="column_content">
                    <h3>Safest way</h3>
                    <p>Safety and confidentiality are our top priorities. </p>
                </div>
                <div class="clear"></div> 
            </div>
            <div class="third_column" data-scroll-reveal="enter from the left after 0.4s">
                <div class="doctor_image"></div>
                <div class="column_content">
                    <h3>Accurate diagnostic</h3>
                    <p>We have the best doctors from around the world in our team. They are here to help you with a professional medical opinion.</p>
                </div>
                <div class="clear"></div> 
            </div>
            <div class="clear"></div>
        </div>
        <div class="separator"></div>
    </div>
    <div class="what_we_do" data-scroll-index='1'>
        <div class="wrapper">
            <div class="what_we_do_left_line"></div><div class="what_we_do_right_line"></div>
            <div class="computer_image" data-scroll-reveal="enter from the bottom after 0.4s">
                <a href="#"></a>
                <div id="movie_frame"></div>
            </div>
            <div class="what_we_do_content" data-scroll-reveal="enter from the left after 0.4s">
                <h2>This is what we do!</h2>
                <p>Our platform provides patients with an electronic storage space for their medical records – easy to use, affordable and quick access to the best doctors from around the world, allowing them to obtain a qualified second opinion at just a single click.</p>
            </div>
            <div class="small_arrow"></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="content_white second_area">
        <div class="separator" data-scroll-reveal="enter from the top after 0.1s"></div>
        <div style="height: 50px;"></div>
        <h3 data-scroll-reveal="enter from the top after 0.2s">Benefits!</h3>
        <h4 data-scroll-reveal="enter from the top after 0.4s">Our aim is to offer you the best services at the lowest possible price</h4>
        <div class="services_included wrapper">
            <div class="services_first_column">
                <div class="row" data-scroll-reveal="enter from the left after 0.3s">
                    <div class="services_icon col-sm-2"></div>
                    <p class="services_text col-sm-10">Expertise – get qualified medical reviews and opinions</p>
                    <div class="clear"></div>
                </div>    
                <div class="row" data-scroll-reveal="enter from the left after 0.5s">
                    <div class="services_icon col-sm-2"></div>
                    <p class="services_text col-sm-10">Cost efficiency – it all happens online; no travel expenditures involved</p>
                    <div class="clear"></div>
                </div>    
            </div>
            <div class="services_second_column">  
                <div class="row" data-scroll-reveal="enter from the right after 0.3s">
                    <div class="services_icon col-sm-2"></div>
                    <p class="services_text col-sm-10">Time management – you will get a response within 48 hours</p>
                    <div class="clear"></div>
                </div>    
                <div class="row" data-scroll-reveal="enter from the right after 0.5s">
                    <div class="services_icon col-sm-2"></div>
                    <p class="services_text col-sm-10">Direct contact – setup a connection with a high class surgeon of your choice</p>
                    <div class="clear"></div>
                </div>    
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <a class="try_it_now_button" data-scroll-reveal="enter from the bottom after 0.2s" href="https://webhippocrates.com/en/default/index/newregister">Try it now!</a>
        <div class="clear"></div>
    </div>    
</div>

<footer>
    <div class="footer_wrapper">
        <div class="copy">&copy; HealthCare Software Alliance</div>
        <nav>
            <a href="https://webhippocrates.com/en/about">about us</a>
            <a href="https://webhippocrates.com/en/terms">terms and conditions</a>
            <a href="https://webhippocrates.com/en/contact">contact us</a>
            <a href="https://webhippocrates.com/en/default/index/newregister">join us</a>
        </nav>
        <div class="clear"></div>
    </div>
</footer>
@endsection
