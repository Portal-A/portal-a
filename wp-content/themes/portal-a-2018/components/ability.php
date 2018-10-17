<?php

function pa_ability( $data ) {

    // $data Schema
    // ------------
    // "title" => "",
    // "content" => "",
    // "sub_abilities" => array(
    //     array( "name" => "" ),
    //     array( "name" => "" ),
    //     array( "name" => "" ),
    // )
    
    ob_start(); ?>

    <a href="#" class="pa-c-ability js-ability">
        <h2 class="pa-c-ability__title"><?php echo $data['title'] ?></h2>
        <div class="pa-c-ability__content">
            <p><?php echo $data['content'] ?></p>
            <div class="pa-l-flexbox pa-l-mt-4 with-gutters does-wrap">
                <?php foreach ( $data['sub_abilities'] as $sub_ability ) : ?>
                    <div class="pa-l-flex span-4-sm"><?php echo $sub_ability['name'] ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </a>

    <?php
    echo ob_get_clean();

}