<?php
/* @var $user backend\models\AppUser */


//$asset = \backend\assets\AppAsset::register($this);
//$baseUrl = $asset->baseUrl;

//$logo = Yii::$app->getUrlManager()->getHostInfo(). '/' . $baseUrl. '/upload/www/header-logo.png';

?>

<div id="mailsub" class="notification" align="center">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
        <tr>
            <td align="center" bgcolor="#eff3f8">

                <!--[if gte mso 10]>
                <table width="680" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-top:50px">
                <![endif]-->

                <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%"
                       style="max-width: 680px; min-width: 300px;">
                    <!--content 1 -->
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <!-- padding -->
                                        <div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
                                        <div style="line-height: 44px;">
                                            <font face="Arial, Helvetica, sans-serif" size="5" color="#57697e"
                                                  style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
						Welcome to iwanadeal
					</span></font>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height: 30px;">
                                            <font face="Arial, Helvetica, sans-serif" size="5" color="#4db3a4"
                                                  style="font-size: 17px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #4db3a4;">
						Hi <?= $name ?>, your registration is completed!
					</span></font>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 35px; line-height: 35px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center">
                                                    <div style="line-height: 24px;">
                                                        <font face="Arial, Helvetica, sans-serif" size="4"
                                                              color="#57697e" style="font-size: 16px;">
									<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                                        Thank you for using our services, please click below button to confirm your registration
									</span></font>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- padding -->
                                        <div style="height: 45px; line-height: 45px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height:24px;">
                                            <a href="<?= Yii::$app->getUrlManager()->getHostInfo() . Yii::$app->urlManager->createUrl(['index.php/site/confirm-registration', 'email' => $email, 'token' => '']) ?>"
                                               target="_blank"
                                               style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
                                                <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3"
                                                      color="#596167">
                                                    CONFIRM REGISTRATION</font></a>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!--content 1 END-->


                    <!--footer -->
                    <tr>
                        <td class="iage_footer" align="center" bgcolor="#eff3f8">
                            <!-- padding -->
                            <div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5"
                                              style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					2016 &copy; iwanadeal.
				</span></font>
                                    </td>
                                </tr>
                            </table>

                            <!-- padding -->
                            <div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
                        </td>
                    </tr>
                    <!--footer END-->
                </table>
                <!--[if gte mso 10]>
                </td></tr>
                </table>
                <![endif]-->

            </td>
        </tr>
    </table>

</div> 
