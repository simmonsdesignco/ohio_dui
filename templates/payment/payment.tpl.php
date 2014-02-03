<?php
/**
 * @file
 * payment.tpl.php
 */
//  NOTE: this will be changed for Purchasing Request for report
global $base_path;
//  Notary status defined on 29-03-2013 mail dated on 29-03-2013
$notary_status = 'inactive';        //  Change $notary_status from inactive to active to show the notary
//  Notary status defined on 29-03-2013

$data = get_cart_items();

$confirm_status = chk_confirm_status();
$cstatus = $confirm_status[0]->confirm_status;
?>

<?php
    $filed_disable = '';
    if($cstatus != 1) {
?>
    <h2><b>Your account is not activated</b></h2>
<?php
    $filed_disable = 'disabled="disable"';;
    }
?>
<h1>Payment</h1>
<div class="wd_1">
    <div class="table_wrap">
        <table class="schedule_table">
                <?php
                $i = 1;
                $total_amount = 0;
                $count = count($cart_data);
                foreach($data as $carddata) {
                    $node_id = $carddata->nid;
                    $term_data = taxonomy_term_load($carddata->tid);

                    //  Amount Calculation START
                    if($carddata->sub_report != 1) {
                        $custom_special_amount = get_special_assessment_custom_amount($node_id);
                        if($custom_special_amount > 0) {
                            $service_amount_main_service = $custom_special_amount;
                        } else {
                            $service_amount_main_service = $term_data->field_assessment_amount['und'][0]['value'];
                        }
                    }
                    
                    if($i == 1) {
                        //  Function call to chk that sub service is already purchased or not
                        $data_subreport_term = check_user_purchased_subreport_term($carddata->nid, 1, 1);
                        foreach($data_subreport_term as $data_subreport) {
                            $sub_purchased_term[] = $data_subreport->termid;
                        }
                    }
                    //if(in_array($carddata->tid, $sub_purchased_term)) {
                      //  $service_amount = 0;
                   // } else {
                        if($term_data->vocabulary_machine_name == 'stateform_vocab') {
                            $service_amount = $term_data->field_stateformamount['und'][0]['value'];
                        } else {
                            $service_amount = $term_data->field_other_service_amount['und'][0]['value'];
                        }
                  //  }
                    
                    $shipping_amount = $carddata->express_mail;
                    $notary_amount = $carddata->notary_amount;
                    $tmp_amount = $service_amount_main_service + $service_amount + $carddata->notary_amount;
                    $tmp_amount_display = $service_amount_main_service + $service_amount;
                    //  Amount Calculation END

                    if($tmp_amount > 0) {
                    //if(true) {
                        if($i == 1) {
                ?>
                            <tr class="bkg_b">
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <?php
                                if($notary_status == 'active') {
                                ?>
                                    <?php if($shipping_amount > 0 || $notary_amount > 0) { ?>
                                        <th>Notary Amount</th>
                                        <th>Sub Total</th>
                                    <?php } ?>
                                <?php
                                }
                                ?>
                            </tr>
                <?php
                        }
                ?>
                        <tr>
                            <td>
                                <?php print $i; ?>
                            </td>
                            <td>
                                <?php
                                    if($term_data->vocabulary_machine_name != 'assessment') {
                                        if($term_data->vocabulary_machine_name == 'stateform_vocab') {
                                            print $term_data->field_stateformtitle['und'][0]['value'];
                                        } else {
                                            print $term_data->name;
                                        }
                                    } else {
                                        $result = node_load($node_id);
                                        switch($term_data->tid) {
                                            case $result->field_primary_service['und'][0]['tid']:
                                                $report_title = $result->field_assessment_title['und'][0]['value'];
                                                break;
                                            case $result->field_rush_order_service_one['und'][0]['tid']:
                                                $report_title = $result->field_rush_order_title_one['und'][0]['value'];
                                                break;
                                            case $result->field_rush_order_service_two['und'][0]['tid']:
                                                $report_title = $result->field_rush_order_title_two['und'][0]['value'];
                                                break;
                                            case $result->field_rush_order_service_three['und'][0]['tid']:
                                                $report_title = $result->field_rush_order_title_three['und'][0]['value'];
                                                break;
                                            case $result->field_rush_order_service_four['und'][0]['tid']:
                                                $report_title = $result->field_rush_order_title_four['und'][0]['value'];
                                                break;
                                        }
                                        print $report_title;
                                    }
                                ?>
                            </td>
                            <td>
                                $<?php print number_format($tmp_amount_display, 2); ?>
                            </td>
                            <?php
                            if($notary_status == 'active') {
                            ?>
                                <?php if($shipping_amount > 0 || $notary_amount > 0) { ?>
                                    <td>
                                        $<?php print number_format($carddata->notary_amount, 2); ?>
                                    </td>
                                    <td>
                                        <?php print $sub_total = number_format(($tmp_amount_display + $carddata->notary_amount), 2); ?>
                                    </td>
                                <?php } ?>
                            <?php
                            }
                            ?>
                        </tr>
                <?php
                        $i++;
                    }
                    $total_amount = $total_amount + $tmp_amount;
                }
                ?>
            <tr>
                <?php if($shipping_amount > 0 || $notary_amount > 0) { ?>
                    <td></td>
                    <td class="bold">Shipping Amount:</td>
                    <td><?php print '$' . number_format($shipping_amount, 2); ?></td>
                    <?php
                    if($notary_status == 'active') {
                    ?>
                        <td>--</td>
                        <td class="bold"><?php print '$' . number_format($shipping_amount, 2); ?></td>
                    <?php
                    }
                    ?>
                <?php } ?>
            </tr>
            <tr>
                <?php
                if($notary_status == 'active') {
                ?>
                    <?php if($shipping_amount > 0 || $notary_amount > 0) { ?>
                        <td></td>
                        <td class="bold">Total Amount:</td>
                        <td colspan="2"></td>
                    <?php } else { ?>
                        <td></td>
                        <td class="bold">Total Amount:</td>
                    <?php } ?>
                <?php
                } else {
                ?>
                    <td></td>
                    <td class="bold">Total Amount:</td>
                <?php
                }
                ?>
                <td class="bold"><?php print '$' . number_format($total_amount + $shipping_amount, 2); ?></td>
            </tr>
        </table>
    </div>

    
    
    
    
    
    <!-- PAYMENT START -->
    <div class="select-payment-method">
        <br />
        <b>Please Select Payment method</b>
        <br /><br />
        <div class="paypalcls">
            <span>  <input type="radio" name="payment_method" class="payment_method" id="payment-paypal" value="paypal" <?php print $filed_disable; ?> />&nbsp;Paypal&nbsp;&nbsp;</span>
              <img src="<?php print $base_path . path_to_theme() . '/images/paypal.png'; ?>" />
        </div>
        <br />
        <div class="paypalcls">
            <span><input type="radio" name="payment_method" class="payment_method" id="payment-creditcard" value="creditcard" <?php print $filed_disable; ?> />&nbsp;Credit Card&nbsp;&nbsp;</span>
            <img src="<?php print $base_path . path_to_theme() . '/images/master-card.png'; ?>" />
        </div>
    </div>

    <div id="paypal-payment" style='display:none;'>
        <b><br />Pay using Paypal:</b>
        <br /><br />
        <?php
        //  Payment Using Paypal
        get_paypal_button_for_payment($node_id);
        ?>
    </div>

    <div id="creditcard-payment" style='display:none;'>
        <b><br />Pay using Credit Card:</b>
        <br /><br />
        <?php
        //  Payment Using Credit Card
        $form = _payment_creditcard();
        ?>
        <div class="form-item_custum">
            <?php print drupal_render($form); ?>
        </div>
    </div>
    <!-- PAYMENT END -->

</div>
<script>
    jQuery(document).ready(function() {
        
        //bind the click event to the radio buttons
        jQuery(':radio').click(function(){
            var radioID = $(this).attr('id');
            if(radioID == 'payment-paypal'){
                jQuery('#creditcard-payment').hide();
                jQuery('#paypal-payment').show();
            } else if(radioID == 'payment-creditcard'){
                jQuery('#paypal-payment').hide();
                jQuery('#creditcard-payment').show();
            }
        });        
        
        jQuery('#credit_card_submit').unbind('click');
        jQuery('#credit_card_submit').bind('click',function() {
            var credit_card = jQuery('#edit-credit-card').val();
            var cc_number = jQuery('#edit-card-number').val();
            var expiration_month = jQuery('#edit-expiration-month').val();
            var expiration_year = jQuery('#edit-expiration-year').val();
            var cvv_code = jQuery('#edit-cvv').val();
            
            if(credit_card == '') {
                alert('Please select your card.');
                return false;
            }
            if(cc_number == '') {
                alert('Please enter your credit card number.');
                return false;
            }
            
            //  Credit Card number validation function called
            if(!checkCreditCard(cc_number, credit_card)) {
                alert(ccErrors[ccErrorNo]);
                return false;
            }
            
            if(expiration_month == '') {
                alert('Please select your card expiration month.');
                return false;
            }
            if(expiration_year == '') {
                alert('Please select your card expiration year.');
                return false;
            }
            if(cvv_code == '') {
                alert('Please enter cvv number.');
                return false;
            }

        });// Bind function closed

    });// Main function closed
</script>
