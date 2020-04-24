<?php 

// Buttons

if(function_exists('vc_map')){

   vc_map( array(

   "name" => esc_html__("OT Button", 'cloudme'),

   "base" => "button",

   "class" => "",

   "category" => 'Content',

   "icon" => "icon-st",

   "params" => array(

      array(

         "type" => "textfield",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Text", 'cloudme'),

         "param_name" => "btntext",

         "value" => "",

         "description" => esc_html__("", 'cloudme')

      ),
      array(

         "type" => "textfield",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Link", 'cloudme'),

         "param_name" => "btnlink",

         "value" => '',

         "description" => esc_html__("", 'cloudme')

      ),

      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Type", 'cloudme'),

         "param_name" => "type",

         "value" => array(   

                     esc_html__('Default', 'cloudme') => 'default',  

                     esc_html__('Primary', 'cloudme') => 'primary',

                     esc_html__('Info', 'cloudme') => 'info',

                     esc_html__('Success', 'cloudme') => 'success',  

                     esc_html__('Warning', 'cloudme') => 'warning',

                     esc_html__('Danger', 'cloudme') => 'danger',
                    ),

         "description" => esc_html__("", 'cloudme')

      ),
      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Size", 'cloudme'),

         "param_name" => "size",

         "value" => array( 

                     esc_html__('Regular size', 'cloudme') => 'default', 

                     esc_html__('Large', 'cloudme') => 'large',

                     esc_html__('Small', 'cloudme') => 'small',
                    ),

         "description" => esc_html__("", 'cloudme')

      ),
      array(

         "type" => "checkbox",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Not Radius ?", 'cloudme'),

         "param_name" => "radius",

         "description" => esc_html__("", 'cloudme')

      ),
    )
    ));

}

// Home Image
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Home Image", 'cloudme'),
   "base"      => "homeimage",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title(Small text)",
         "param_name" => "title",
         "value" => "",
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Slide Text(Big Text)", 'cloudme'),
         "param_name" => "slide",
         "value" => "",
         "description" => esc_html__("Enter text for slider (Note: divide with ','). Example: text1, text2, text3.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'cloudme'),
         "param_name" => "btn",
         "value" => "",
      ),
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Link", 'cloudme'),
         "param_name" => "link",
         "value" => "",
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Background Image",
         "param_name" => "bg",
         "value" => "",
         "description" => esc_html__("Upload image background.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Min height", 'cloudme'),
         "param_name" => "mheight",
         "value" => "",
         "description" => esc_html__("Min height section. Default: 580px", 'cloudme')
      )
    )));
}

//Register "container" content element. It will hold all your inner (child) content elements
if(function_exists('vc_map')){
vc_map( array(
    "name"                    => esc_html__("Home Slider", "cloudme"),
    "base"                    => "homeslide",
    "as_parent"               => array('only' => 'slide_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"         => true,
    "icon"                    => "icon-st",
    "show_settings_on_create" => false,
    "params"                  => array(
         array(
            "type"       => "textfield",
            "heading"    => esc_html__("Slider Speed", "cloudme"),
            "param_name" => "speed",
         ),
         array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Bottom Slider", "cloudme"),
            "param_name" => "cloud",
        ),
        // add params same as with any other content element
        array(
            "type"        => "textfield",
            "heading"     => esc_html__("Extra class name", "cloudme"),
            "param_name"  => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cloudme")
        )
    ),
    "js_view" => 'VcColumnView'
) );
}
if(function_exists('vc_map')){
vc_map( array(
    "name" => esc_html__("Slide Item", "cloudme"),
    "base" => "slide_item",
    "content_element" => true,
    "icon" => "icon-st",
    "as_child" => array('only' => 'homeslide'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Slide", "cloudme"),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Big Text Slide", "cloudme"),
            "param_name" => "btext",
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Small Text Slide", "cloudme"),
            "param_name" => "stext",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label Button", "cloudme"),
            "param_name" => "btn",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link Button", "cloudme"),
            "param_name" => "link",
        ),
    )
) );
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Homeslide extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Slide_Item extends WPBakeryShortCode {
    }
}


//Background Video

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Background Video", 'cloudme'),
   "base"      => "bgvideo",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title(Small text)",
         "param_name" => "title",
         "value" => "",
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Slide Text(Big Text)", 'cloudme'),
         "param_name" => "slide",
         "value" => "",
         "description" => esc_html__("Enter text for slider (Note: divide with ','). Example: text1, text2, text3.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'cloudme'),
         "param_name" => "btn",
         "value" => "",
      ),
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Link", 'cloudme'),
         "param_name" => "link",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link mp4",
         "param_name" => "mp4",
         "value" => "",
         "description" => esc_html__("Input link mp4 video html5.", 'cloudme')
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link webm",
         "param_name" => "webm",
         "value" => "",
         "description" => esc_html__("Input link webm video html5", 'cloudme')
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link ogv",
         "param_name" => "ogv",
         "value" => "",
         "description" => esc_html__("Input link ogv video html5.", 'cloudme')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => "Video Muted?",
         "param_name" => "mute",
         "value" => "",
         'group'       => esc_html__( 'Extra Options', 'cloudme' ),
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Bottom Image",
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image bottom.", 'cloudme')
      ),
    )));
}

// Call To Action

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Call To Action", 'cloudme'),
   "base" => "ctabox",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title 1",
         "param_name" => "title1",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title 2",
         "param_name" => "title2",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Subtitle",
         "param_name" => "stitle",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Button",
         "param_name" => "link",
         "value" => "",
      ),
    )
    ));
}

// Form search domain
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Search Domain Form", 'cloudme'),
   "base"      => "cloudme_search_domain",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title(Small text)",'cloudme'),
         "param_name" => "title",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle(Big Text)", 'cloudme'),
         "param_name" => "subt",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link WHMCS", 'cloudme'),
         "param_name" => "actionlink",
         "value" => "",
         "description" => wp_kses( __( 'Enter link your whmcs,<br> 
          Example 1: http://demo.vegatheme.com/cloudme/whmcs-bridge <br>
          Example 2: http://demo.vegatheme.com/whmcs6', 'cloudme' ), wp_kses_allowed_html('post') )
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Use WHMCS Bridge?",'cloudme'),
         "param_name" => "bridge",
         "value" => "",
         "description" => esc_html__("Tick this if link WHMCS like as: http://demo.vegatheme.com/cloudme/whmcs-bridge", 'cloudme')
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("List Domains", 'cloudme'),
         "param_name" => "domain",
         "value" => "",
         "description" => esc_html__("List Domain show in silder. Follow structure: .com|.net|.info", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Change Image Loading", 'cloudme'),
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image loading search.", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Background Image", 'cloudme'),
         "param_name" => "bg",
         "value" => "",
         "description" => esc_html__("Upload image background.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Min height", 'cloudme'),
         "param_name" => "mheight",
         "value" => "",
         "description" => esc_html__("Min height section. Default: 580px", 'cloudme')
      )
    )));
}


// Pricing Table
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Pricing Table", 'cloudme'),
   "base" => "pricingtable",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Pricing", 'cloudme'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Price Pricing", 'cloudme'),
         "param_name" => "price",
         "value" => "",
         "description" => esc_html__("Price display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Time", 'cloudme'),
         "param_name" => "per",
         "value" => "",
         "description" => esc_html__("Per Month or Year display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Detail Pricing", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Content Pricing Table.", 'cloudme')
      ),
     array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'cloudme'),
         "param_name" => "btn",
         "value" => "",
         "description" => esc_html__("Text display in button.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link Button", 'cloudme'),
         "param_name" => "link",
         "value" => "",
         "description" => esc_html__("Link in button.", 'cloudme')
      ),
    )));
}

// Pricing Table Compare
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Pricing Table Compare", 'cloudme'),
   "base" => "pricingtable2",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Header Column?", 'cloudme'),
         "param_name" => "head",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Pricing", 'cloudme'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Price Pricing", 'cloudme'),
         "param_name" => "price",
         "value" => "",
         'dependency'  => array( 'element' => 'head', 'is_empty' => true ),
         "description" => esc_html__("Price display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Time", 'cloudme'),
         "param_name" => "per",
         "value" => "",
         'dependency'  => array( 'element' => 'head', 'is_empty' => true ),
         "description" => esc_html__("Per Month or Year display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Detail Pricing", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Content Pricing Table.", 'cloudme')
      ),
     array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'cloudme'),
         "param_name" => "btn",
         "value" => "",
         'dependency'  => array( 'element' => 'head', 'is_empty' => true ),
         "description" => esc_html__("Text display in button.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link Button", 'cloudme'),
         "param_name" => "link",
         "value" => "",
         'dependency'  => array( 'element' => 'head', 'is_empty' => true ),
         "description" => esc_html__("Link in button.", 'cloudme')
      ),
    )));
}

//Features Shared

if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Shared Features", 'cloudme'),
   "base" => "shared",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'cloudme'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Text Button 1", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Text Button 2", 'cloudme')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Content Left?", 'cloudme'),
         "param_name" => "lr",
         "value" => "",
         "description" => esc_html__("Text Button 3", 'cloudme')
      ),
    )));
}

// Domains Price
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Domains Price", 'cloudme'),
   "base" => "domainprice",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Header Column?", 'cloudme'),
         "param_name" => "head",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Pricing", 'cloudme'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in Pricing Table.", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Detail Pricing", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Content Pricing Table.", 'cloudme')
      )
    )));
}

//Compare Table

if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Compare Table", 'cloudme'),
   "base" => "compare_table",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
        "type"        => 'textarea',
        "holder"      => 'div',
        "heading"     => esc_html__('Titles','cloudme'),
        "param_name"  => 'titles',
        "value"       => '',
        "description" => esc_html__("Enter titles for element (Note: divide columns with '|').",'cloudme')
      ),
      array(
        "type"        => 'textarea_html',
        "holder"      => 'div',
        "heading"     => esc_html__('Content','cloudme'),
        "param_name"  => 'content',
        'value'       => '',
        "description" => esc_html__("Enter the content ( Note: divide columns with '|' and devide rows with linebreaks (Enter)).",'cloudme')
      ),
      array(
        'type'        => 'textfield',
        'holder'      => 'div',
        'heading'     => esc_html__( 'Extra class name', 'cloudme' ),
        'param_name'  => 'class_name',
        'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cloudme' ),
      ),
    )));
}


//Clients Logo 

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Client Logos", 'cloudme'),
   "base"      => "logos",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => "Logo Client",
         "param_name" => "gallery",
         "value" => "",
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number", 'cloudme'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Number Images Visible. Default: 6.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Carousel Speed", 'cloudme'),
         "param_name" => "speed",
         "value" => "",
         "description" => esc_html__("Default: 5000.", 'cloudme')
      )
    )));
}


// Features Box

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Features Box", 'cloudme'),
   "base" => "featurebox",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Box",
         "param_name" => "icon",
         "value" => "",
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Image",
         "param_name" => "photo",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title",
         "param_name" => "title",
         "value" => "",
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => "Description",
         "param_name" => "content",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Button",
         "param_name" => "link",
         "value" => "",
      ),
    )
    ));
}


// Services
if(function_exists('vc_map')){
	
	vc_map( array(
   "name" => esc_html__("OT Services Box", 'cloudme'),
   "base" => "services",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Type Box", 'cloudme'),

         "param_name" => "type",

         "value" => array(

                     esc_html__('Box with icon left', 'cloudme') => 'type1', 

                     esc_html__('Box with image left', 'cloudme') => 'type2',
                    ),

         "description" => esc_html__("", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'cloudme'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in box.", 'cloudme')
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon Left", 'cloudme'),
         "param_name" => "icon",
         "value" => "",
         'dependency'  => array( 'element' => 'type', 'value' => array( 'type1' ) ),
         "description" => esc_html__("Upload image left service.", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Image Left", 'cloudme'),
         "param_name" => "image",
         "value" => "",
         'dependency'  => array( 'element' => 'type', 'value' => array( 'type2' ) ),
         "description" => esc_html__("Icon in box. Add class follow: http://fontawesome.io/icons/", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Detail in box.", 'cloudme')
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Background Box", 'cloudme'),
         "param_name" => "bg",
         "value" => "",
      ),
    )
    ));
}


// Support Box
if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Support Box", 'cloudme'),
   "base" => "supportbox",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Detail in box.", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon Image", 'cloudme'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Upload icon image", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Big Image", 'cloudme'),
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image left or right", 'cloudme')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description in right?", 'cloudme'),
         "param_name" => "right",
         "value" => ""
      ),   
    )
    ));
}

// VPS Order
if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT VPS Order", 'cloudme'),
   "base" => "vpsorder",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'cloudme'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in box.", 'cloudme')
      ),
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Top Image", 'cloudme'),
         "param_name" => "image",
         "value" => "",
         "description" => esc_html__("Upload image top.", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Order", 'cloudme'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Input number int.", 'cloudme')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'cloudme'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Detail in box.", 'cloudme')
      ),
      
    )
    ));
}


//Register "container" content element. It will hold all your inner (child) content elements
if(function_exists('vc_map')){
vc_map( array(
    "name"                    => esc_html__("VPS Plans", "cloudme"),
    "base"                    => "vpsplans",
    "as_parent"               => array('only' => 'single_plan'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"         => true,
    "icon"                    => "icon-st",
    "show_settings_on_create" => false,
    "params"                  => array(
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title Header", "cloudme"),
            "param_name" => "title",
        ),
        array(
            "type"       => "attach_image",
            "heading"    => esc_html__("Background Header", "cloudme"),
            "param_name" => "bg",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Label Button Order", "cloudme"),
            "param_name" => "btn",
        ),
         array(
            "type"       => "textfield",
            "heading"    => esc_html__("Start Point", "cloudme"),
            "param_name" => "point",
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__("Extra class name", "cloudme"),
            "param_name"  => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cloudme")
        )
    ),
    "js_view" => 'VcColumnView'
) );
}
if(function_exists('vc_map')){
vc_map( array(
    "name" => esc_html__("VPS Single Plan", "cloudme"),
    "base" => "single_plan",
    "content_element" => true,
    "icon" => "icon-st",
    "as_child" => array('only' => 'vpsplans'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cloudme"),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("CPU", "cloudme"),
            "param_name" => "cpu",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Disk Space", "cloudme"),
            "param_name" => "disk",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Ram", "cloudme"),
            "param_name" => "ram",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Bandwidth", "cloudme"),
            "param_name" => "band",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price", "cloudme"),
            "param_name" => "price",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link", "cloudme"),
            "param_name" => "link",
        ),
    )
) );
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_VPSPlans extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Single_Plan extends WPBakeryShortCode {
    }
}

// Testimonial Slider

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Testimonials Slider", 'cloudme'),
   "base" => "testslide",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Number Testimonial",
         "param_name" => "number",
         "value" => "",
      ),
    )
    ));
}

// Testimonial Grid

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Testimonials Grid", 'cloudme'),
   "base" => "testigrid",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Number Testimonial",
         "param_name" => "number",
         "value" => "",
      ),
    )
    ));
}

// FAQs

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT FAQ", 'cloudme'),
   "base" => "otfaqs",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Question",
         "param_name" => "question",
         "value" => "",
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => "Answer",
         "param_name" => "content",
         "value" => "",
      ),
    )
    ));
}

// Socials Item

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Social Item", 'cloudme'),
   "base" => "socialitem",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Social",
         "param_name" => "icon",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Social",
         "param_name" => "link",
         "value" => "",
      ),
    )
    ));
}

//Google Map

if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Google Map", 'cloudme'),
   "base" => "ggmap",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(  
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("ID Map", 'cloudme'),
         "param_name" => "idmap",
         "value" => "map-canvas",
         "description" => esc_html__("Please enter ID Map, map-canvas1, map-canvas2, map-canvas3, ..etc", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Height Map", 'cloudme'),
         "param_name" => "height",
         "value" => 320,
         "description" => esc_html__("Please enter number height Map, 300, 350, 380, ..etc. Default: 420.", 'cloudme')
      ),    
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Latitude", 'cloudme'),
         "param_name" => "lat",
         "value" => -37.817,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'cloudme')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Longitude", 'cloudme'),
         "param_name" => "long",
         "value" => 144.962,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'cloudme')

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Zoom Map", 'cloudme'),
         "param_name" => "zoom",
         "value" => 13,
         "description" => esc_html__("Please enter Zoom Map, Default: 15", 'cloudme')
      ),
    array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Map color", 'cloudme'),
            "param_name" => "mapcolor",
            "value" => '', //Default White color
            "description" => esc_html__("Choose Map color", 'cloudme')
         ),
     
    array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Map marker",
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Icon Map marker, 47 x 68", 'cloudme')
      ),  
       
    )));

}

//Google Map2

if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Multiple Markers Map", 'cloudme'),
   "base" => "ggmap2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array( 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Height Map", 'cloudme'),
         "param_name" => "height",
         "value" => 320,
         "description" => esc_html__("Please enter number height Map, 300, 350, 380, ..etc. Default: 420.", 'cloudme')
      ),    
      array(
          'type' => 'param_group',
          'heading' => esc_html__("Address", 'buildpro'),
          'value' => '',
          'param_name' => 'address',
          // Note params is mapped inside param-group:
          'params' => array(
               array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => esc_html__('Latitude and Longitude', 'buildpro'),
                  'param_name' => 'llong',
                  "description" => esc_html__("Please enter http://www.latlong.net/ Latitude,Longitude google map. Example: 39.98978,-83.00632.", 'cloudme')
               ),
               array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => esc_html__('Infomation', 'buildpro'),
                  'param_name' => 'info',
               ),
          )
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Zoom Map", 'cloudme'),
         "param_name" => "zoom",
         "value" => "",
         "description" => esc_html__("Please enter Zoom Map, Default: 15", 'cloudme')
      ),
    array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Map marker",
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Icon Map marker, 47 x 68", 'cloudme')
      ),  
       
    )));

}
?>