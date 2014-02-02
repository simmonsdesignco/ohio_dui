<?php
global $user;
global $base_url;

//  Used to get the page static content from DB
//echo '<pre>';
//print_r($node);
//echo '</pre>';


//  custom image path defined
$path_image = $base_path . path_to_theme() . '/' . 'images';
//$assessment_title_name = arg(1);
//$url_node = drupal_get_normal_path($assessment_title_name);
//$explode_url_node = explode('/', $url_node);
$arg3 = arg(1);

$assessment_node = get_assessment_information(arg(1));
$nid_array = array();
foreach ($assessment_node as $data) {
    $nid_array[] = $data->nid;
}

//  load the node data
$result_node = node_load_multiple($nid_array);
foreach($result_node as $node_data) {
    $result = $node_data;
}

//echo '<pre>';
//print_r($result);
//echo '</pre>';
$link_path = drupal_lookup_path('alias', "node/".arg(1));
?>
<div class="layout fix_layout">
    <?php
    //  header included
    include_once 'header.tpl.php';
    ?>

    <!--contents starts here-->
    <div class="contents assessments_contents">
        <div class="contents_inner">
            <?php
                if($result->field_asmentinfo_section_one['und'][0]['value'] <> '') {
            ?>
                    <?php print $result->field_asmentinfo_section_one['und'][0]['value']; ?>
                    <?php if($result->field_assessment_right_image['und'][0]['uri'] <> '') { ?>
                              <img src="<?php print image_style_url('page_images', $result->field_assessment_right_image['und'][0]['uri']); ?>" class="thick right" alt="">
                    <?php } ?>
            <?php
                }
            ?>
            <?php $primary_service_amount = get_service_amount($result->field_primary_service['und'][0]['tid']); ?>
            <?php
                if($primary_service_amount > 0) {
            ?>
                <div class="dashed_wrap">
                    <!--
                    <h1>
                        <?php //print $result->field_assessment_title['und'][0]['value']; ?>
                        <span>(In Person, By Phone, By Webcam Interview)</span>
                    </h1>
                    -->
                    <div class="as_contents">
                        <?php
                            print $result->field_service_description['und'][0]['value'];
                        ?>
                    </div>

                    <div class="order_bg right">
                        <div class="price">$ <?php print $primary_service_amount; ?></div>
                        <div class="opg">
                            <?php
                                //  Path generated for logged in user and unlogged user
                                if($user->uid <= 0) {
                                    $redirect_url = $base_url . '/user/login?destination=' . $link_path;
                                } else {
                                    $redirect_url = $base_url . '/user/cart/nid/'.$arg3.'/tid/' . $result->field_primary_service['und'][0]['tid'];
                                }
                            ?>
                            <a href="<?php print $redirect_url; ?>" class="grey_btn">Purchase Now</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            <?php
                if($result->field_rush_order_status_one['und'][0]['value'] == 'Active' || 
                        $result->field_rush_order_status_two['und'][0]['value'] == 'Active' || 
                        $result->field_rush_order_status_three['und'][0]['value'] == 'Active' || 
                        $result->field_rush_order_status_four['und'][0]['value'] == 'Active') {
            ?>
                    <div class="dashed_wrap">
                        <h1>Rush Order Fees Ver Depending Upon Timeframe</h1>
                        
                            <div class="col4"><h2><?php print $result->field_rush_order_title_one['und'][0]['value']; ?></h2></div>
                            <div class="col4"><h2><?php print $result->field_rush_order_title_two['und'][0]['value']; ?></h2></div>
                            <div class="col4"><h2><?php print $result->field_rush_order_title_three['und'][0]['value']; ?></h2></div>
                            <div class="col4 last"><h2><?php print $result->field_rush_order_title_four['und'][0]['value']; ?></h2></div>
                            <div class="clear"></div>
                        <?php
                            if($result->field_rush_order_status_one['und'][0]['value'] == 'Active') {
                        ?>
                            <div class="col4">
                                
                                <div class="order_bkg">
                                    <div class="price">$ <?php print get_service_amount($result->field_rush_order_service_one['und'][0]['tid']); ?></div>
                                        <div class="opg">
                                            <?php
                                                //  Path generated for logged in user and unlogged user
                                                if($user->uid <= 0) {
                                                    $redirect_url = $base_url . '/user/login?destination=' . $link_path;
                                                } else {
                                                    $redirect_url = $base_url . '/user/cart/nid/'.$arg3.'/tid/' . $result->field_rush_order_service_one['und'][0]['tid'];
                                                }
                                            ?>
                                            <a href="<?php print $redirect_url; ?>" class="grey_btn">Purchase Now</a>
                                        </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($result->field_rush_order_status_two['und'][0]['value'] == 'Active') { ?>
                            <div class="col4">
                                
                                <div class="order_bkg">
                                    <div class="price">$ <?php print get_service_amount($result->field_rush_order_service_two['und'][0]['tid']); ?></div>
                                    <div class="opg">
                                        <?php
                                            //  Path generated for logged in user and unlogged user
                                            if($user->uid <= 0) {
                                                $redirect_url = $base_url . '/user/login?destination=' . $link_path;
                                            } else {
                                                $redirect_url = $base_url . '/user/cart/nid/'.$arg3.'/tid/' . $result->field_rush_order_service_two['und'][0]['tid'];
                                            }
                                        ?>
                                        <a href="<?php print $redirect_url; ?>" class="grey_btn">Purchase Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($result->field_rush_order_status_three['und'][0]['value'] == 'Active') { ?>
                            <div class="col4">
                                
                                <div class="order_bkg">
                                    <div class="price">$ <?php print get_service_amount($result->field_rush_order_service_three['und'][0]['tid']); ?></div>
                                    <div class="opg">
                                        <?php
                                            //  Path generated for logged in user and unlogged user
                                            if($user->uid <= 0) {
                                                $redirect_url = $base_url . '/user/login?destination=' . $link_path;
                                            } else {
                                                $redirect_url = $base_url . '/user/cart/nid/'.$arg3.'/tid/' . $result->field_rush_order_service_three['und'][0]['tid'];
                                            }
                                        ?>
                                        <a href="<?php print $redirect_url; ?>" class="grey_btn">Purchase Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($result->field_rush_order_status_four['und'][0]['value'] == 'Active') { ?>
                        <div class="col4 last">
                            
                            <div class="order_bkg">
                                <div class="price">$ <?php print get_service_amount($result->field_rush_order_service_four['und'][0]['tid']); ?></div>
                                <div class="opg">
                                    <?php
                                        //  Path generated for logged in user and unlogged user
                                        if($user->uid <= 0) {
                                            $redirect_url = $base_url . '/user/login?destination=' . $link_path;
                                        } else {
                                            $redirect_url = $base_url . '/user/cart/nid/'.$arg3.'/tid/' . $result->field_rush_order_service_four['und'][0]['tid'];
                                        }
                                    ?>
                                    <a href="<?php print $redirect_url; ?>" class="grey_btn">Purchase Now</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="clear">
                            <a href="<?php print $base_url . '/user/register'; ?>">Register Here >></a>
                            <p class="note mt_20"><b>Note:</b> <span>All timeframes above assume completion of your interview with the evaluator and submission by you of any required forms.</span></p>
                        </div>
                    </div>
            <?php
                }
            ?>
            <?php
                if($result->field_asmentinfo_section_two['und'][0]['value'] <> '') {
            ?>
                    <div class="dashed_wrap">
                        <?php print $result->field_asmentinfo_section_two['und'][0]['value']; ?>
                    </div>
            <?php
                }
            ?>
            
            <?php
                if($result->field_asmentinfo_section_three['und'][0]['value'] <> '') {
            ?>
                    <div class="dashed_wrap">
                        <?php print $result->field_asmentinfo_section_three['und'][0]['value']; ?>
                    </div>
            <?php
                }
            ?>
            
            <?php
                if($result->field_asmentinfo_section_four['und'][0]['value'] <> '') {
            ?>
                    <div class="dashed_wrap">
                        <?php print $result->field_asmentinfo_section_four['und'][0]['value']; ?>
                    </div>
            <?php
                }
            ?>
            
        </div>
    </div>        
    <!--contents ends here-->

    <div class="footer">
        <?php
            //  footer included
            include_once 'footer_sub.tpl.php';
            //  footer included
            include_once 'footer.tpl.php';
        ?>
    </div>
</div>
