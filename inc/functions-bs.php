<?php
#[gnik_btn url="#" class=""]Click Here[/gnik_btn]
function gnik_btn_func($atts, $cotent="Link") {
    $a = shortcode_atts( array(
        'url' => '/',
        'title' => $cotent,
        'style' => 'flat',
        'class' => 'btn-success',
        'align' => 'left',
        'color' => '#0DB04B',
        'size' => 'btn-md',
        'target' => 'self',
        'rel' => 'none'
    ), $atts );
    
    return "<a title=\"{$a['title']}\" target=\"{$a['target']}\" href=\"{$a['url']}\" class=\"btn {$a['class']} {$a['size']}\">{$cotent}</a> ";
}
add_shortcode( 'gnik_btn' , 'gnik_btn_func' );
	
	
?>