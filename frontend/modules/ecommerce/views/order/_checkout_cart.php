<?php
use common\components\FHtml;
use frontend\components\FEcommerce;
use backend\modules\ecommerce\models\Product;

$asset = \frontend\assets\CustomAsset::register($this);
$baseUrl = $asset->baseUrl;
$total = 0;
$price = 0;
$total_price = 0;
$data = FEcommerce::getCartData();
$total_price = $data['total_price'];
$description = $data['description'];

?>


    <div class="row" >
        <div class="col-md-6 md-margin-bottom-50" >
            <h2 class="title-type" > Choose a payment method </h2 >
            <!--Accordion -->
            <div class="accordion-v2" >
                <div class="panel-group" id = "accordion" >
                    <div class="panel panel-default" >
                        <div class="panel-heading" >
                            <h4 class="panel-title" >
                                <a data - toggle = "collapse" data - parent = "#accordion" href = "#collapseOne" >
                                    <i class="fa fa-credit-card" ></i >
Credit or Debit Card
</a >
                            </h4 >
                        </div >
                        <div id = "collapseOne" class="panel-collapse collapse in" >
                            <div class="panel-body cus-form-horizontal" >
                                <div class="form-group" >
                                    <label class="col-sm-4 no-col-space control-label" > Cardholder Name </label >
                                    <div class="col-sm-8" >
                                        <input type = "text" class="form-control" name = "cardholder" placeholder = "" >
                                    </div >
                                </div >
                                <div class="form-group" >
                                    <label class="col-sm-4 no-col-space control-label" > Card Number </label >
                                    <div class="col-sm-8" >
                                        <input type = "text" class="form-control" name = "cardnumber" placeholder = "" >
                                    </div >
                                </div >
                                <div class="form-group" >
                                    <label class="col-sm-4 no-col-space control-label" > Payment Types </label >
                                    <div class="col-sm-8" >
                                        <ul class="list-inline payment-type" >
                                            <li ><i class="fa fa-cc-paypal" ></i ></li >
                                            <li ><i class="fa fa-cc-visa" ></i ></li >
                                            <li ><i class="fa fa-cc-mastercard" ></i ></li >
                                            <li ><i class="fa fa-cc-discover" ></i ></li >
                                        </ul >
                                    </div >
                                </div >
                                <div class="form-group" >
                                    <label class="col-sm-4" > Expiration Date </label >
                                    <div class="col-sm-8 input-small-field" >
                                        <input type = "text" id = "exp_date" name = "exp_date" placeholder = "Expiration date (MM/YY)" class="form-control sm-margin-bottom-20" >
                                    </div >
                                </div >
                                <div class="form-group" >
                                    <label class="col-sm-4 no-col-space control-label" > CSV</label >
                                    <div class="col-sm-8 input-small-field" >
                                        <input type = "text" name = "number" placeholder = "" class="form-control" >
                                        <a href = "#" > What's this?</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Amount</label>
                                    <span><b><?= FHtml::showCurrency($total_price) ?></b></span>
                                    <div class="col-sm-8 input-small-field">
                                        <input  name="amount" type="hidden" value="<?= $total_price ?>"  class="form-control sm-margin-bottom-20">
                                    </div>
                                </div>
                                <?php
                                if (isset($_REQUEST['error']) && $_REQUEST['error']!='') {
                                    echo "<div style='color: red'>" . $_REQUEST['error'] . "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <i class="fa fa-paypal"></i>
                                    Pay with PayPal
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="content margin-left-10">
                                <a href="#"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_150x38.png" alt="PayPal"></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="title-type">Frequently asked questions</h2>
            <!-- Accordion -->
            <div class="accordion-v2 plus-toggle">
                <div class="panel-group" id="accordion-v2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseOne-v2">
                                    What payments methods can I use?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne-v2" class="panel-collapse collapse in">
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseTwo-v2">
                                    Can I use gift card to pay for my purchase?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo-v2" class="panel-collapse collapse">
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseThree-v2">
                                    Will I be charged when I place my order?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree-v2" class="panel-collapse collapse">
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseFour-v2">
                                    How long will it take to get my order?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour-v2" class="panel-collapse collapse">
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Accordion -->
        </div>
    </div>
