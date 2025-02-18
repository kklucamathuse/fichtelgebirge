<?php
//COMPANY
function shortcode_company(){
    $company = get_field('company', 'option');
    return $company;
}
add_shortcode( 'company', 'shortcode_company' );

//STREET
function shortcode_street(){
    $street = get_field('street', 'option');
    return $street;
}
add_shortcode( 'street', 'shortcode_street' );

//PLACE
function shortcode_place(){
    $place = get_field('place', 'option');
    return $place;
}
add_shortcode( 'place', 'shortcode_place' );

//PHONE
function shortcode_phone(){
    $phone = get_field('phone', 'option');
    return $phone;
}
add_shortcode( 'phone', 'shortcode_phone' );

//PHONE LINK
function shortcode_phonelink(){
    $phone = get_field('phone', 'option');
    $phonelink = preg_replace("/[^0-9+]/", "",$phone);
    return $phonelink;
}
add_shortcode( 'phonelink', 'shortcode_phonelink' );

//FAX
function shortcode_fax(){
    $fax = get_field('fax', 'option');
    return $fax;
}
add_shortcode( 'fax', 'shortcode_fax' );

//EMAIL
function shortcode_email(){
    $email = get_field('email', 'option');
    return $email;
}
add_shortcode( 'email', 'shortcode_email' );

//OFFICE HOURS
function shortcode_office_hours(){
    $hours = get_field('office-hours', 'option');
    return $hours;
}
add_shortcode( 'hours', 'shortcode_office_hours' );

//FACEBOOK
function shortcode_facebook(){
    $facebook = get_field('facebook', 'option');
    return $facebook;
}
add_shortcode( 'facebook', 'shortcode_facebook' );

//YOUTUBE
function shortcode_youtube(){
    $youtube = get_field('youtube', 'option');
    return $youtube;
}
add_shortcode( 'youtube', 'shortcode_youtube' );

//INSTGRAM
function shortcode_instagram(){
    $instagram = get_field('instagram', 'option');
    return $instagram;
}
add_shortcode( 'instagram', 'shortcode_instagram' );

//KK IMPRESSUM
function shortcode_kk_impressum(){
    $impressum = '<h3>Design und technische Umsetzung</h3>
                 <p><strong>kreativkarussell GmbH</strong><br />
                 Gartenstraße 1a<br />
                 59929 Brilon</p>
                 <p><a href="mailto:info@kreativkarussell.de">info@kreativkarussell.de</a><br />
                 <a href="https://www.kreativkarussell.de/">www.kreativkarussell.de</a></p>';

    return $impressum;
}
add_shortcode( 'impressum', 'shortcode_kk_impressum' );
