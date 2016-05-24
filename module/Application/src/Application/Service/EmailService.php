<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Entity\UserAuthentication;
use Application\Util\HttpClient;
use Zend\Json\Json;
use Zend\Form\Annotation\Object;
use Application\Util\EmailUtil;

class EmailService extends AbstractService
{
    public function registrationEmail($to,$subject,$content,$is_html=true)
    { 
    	$emailUtilObj = new EmailUtil();
    	if($emailUtilObj->sendEmail($to, $subject, $content)){
    		return true;
    	}else{
    		return false;
    	}    	
    		
    } 
    public function getRegisterEmailContent($data){
    	return <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Resume to work</title>
<style>
/* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
#outlook a {
	padding: 0;
} /* Force Outlook to provide a "view in browser" message */
.ReadMsgBody {
	width: 100%;
}
.ExternalClass {
	width: 100%;
} /* Force Hotmail to display emails at full width */
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
	line-height: 100%;
} /* Force Hotmail to display normal line spacing */
body, table, td, p, a, li, blockquote {
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
} /* Prevent WebKit and Windows mobile changing default text sizes */
table, td {
	mso-table-lspace: 0pt;
	mso-table-rspace: 0pt;
} /* Remove spacing between tables in Outlook 2007 and up */
img {
	-ms-interpolation-mode: bicubic;
} /* Allow smoother rendering of resized image in Internet Explorer */
/* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
body {
	margin: 0;
	padding: 0;
}
img {
	border: 0;
	height: auto;
	line-height: 100%;
	outline: none;
	text-decoration: none;
}
a:hover {
	color: #0b87cf;
}
 @media screen and (min-width: 601px) {
 .container {
 width: 600px!important;
}
}
 @media screen and (max-width: 525px) {
	/* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
	body, table, td, p, a, li, blockquote {
 -webkit-text-size-adjust: none !important;
} /* Prevent Webkit platforms from changing default text sizes */
 body {
 width: 100% !important;
 min-width: 100% !important;
} /* Prevent iOS Mail from adding padding to the body */
 table {
 width: 100% !important;
 max-width: 100% !important;
 text-align: left !important;
}
}
</style>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" offset="0">
<center>
  <!-- //Header Outer Table -->
  <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f2f2f2" style="padding: 10px 10px 0; font-family: 'Helvetica', Arial, sans-serif; font-size: 14px;">
    <tr>
      <td align="center" valign="top"><!-- //Header post Table -->
        
        <table class="container" cellpadding="0" cellspacing="0" border="0"0 style="max-width: 600px; width: 100%; background:#ffffff; border: solid 1px #cccccc;">
          <tr>
            <td style="text-align: center; vertical-align: top; width: 100%;"><table cellspacing="0" cellpadding="0" style="background:#ffffff;width:100%; padding: 20px 20px 10px;">
                <tr>
                  <td align="left"><h2 style="font-weight: 300; color: #666666; margin: 0px;">Resume2Work</h2></td>
                  <td align="right"><a href="https://resumes2work.com" style="background: #f1f1f1; display: inline-block; padding: 5px 10px; color:#555555; text-decoration: none; border: solid 1px #aaa;">Sign In</a></td>
                </tr>
              </table>
              <hr color="#CCCCCC" size="1" />
              <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; padding-left: 20px; padding-right: 20px; padding-bottom: 20px;">
                <tr>
                  <td align="left" style="font-size:15px;font-weight:normal" colspan="2">
                  <p style="line-height:1.6;color:#555555;"> Hi {$data['name']},</p>
                      
                     <p style="line-height:1.6; margin-bottom:0; color:#555555;"> Welcome to the Resume2Work job alert program! Starting tomorrow, we'll send you daily emails that highlight the latest and greatest job opportunities for you.</p>
                   </td>
                </tr>
                <tr>
                	<td  align="left">
                    <table width="100%" bgcolor="#efefef" style="margin: 15px 0; padding: 0 10px 10px;border: solid 1px #cccccc;">
                    <tr>
                    <td>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;"><strong>Your Login information</strong></p>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;">Username: {$data['email']} </p>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;"><a href="{$data['resetLink']}" style="color:#039">Click here</a> to set your password</p>
                    </td>
                    </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                	<td align="left">
                     
                     <p style="line-height:1.6; margin-bottom:0; color:#555555;">Our promise</p>
                    
                    <ul style="line-height:1.6; margin-bottom:0; color:#555555;">
                      <li>We'll never sell/share your personal info to 3rd parties, except those you authorize.</li>
                      <li>We never charge you to find a job. If you are prompted to pay an application or screening for a job you found through Resumes2Work, please let us know immediately.</li>
                    </ul>
                    </td>
                    </tr>
                    <tr>
                    <td align="left">
                    <hr color="#CCCCCC" size="1" />
                    <p style="line-height:1.6; margin-bottom:0; color:#555555;"><strong>Good luck in your job search!</strong></p>
                    <p style="line-height:1.6; margin-bottom:0; color:#555555;">- The Resume2Work team</p>
                    </td>
                </tr>
              </table></td>
          </tr>
        </table>
        
        <!-- Header post Table //--></td>
    </tr>
  </table>
  <table cellspacing="0" cellpadding="0" align="center" style="width:100%;background:#f2f2f2">
    <tbody>
      <tr>
        <td align="center" style="padding:20px 0 10px 0"><table class="container" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background:#f2f2f2;">
            <tbody>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px"> <a href="#" style="color:#1283b3;text-decoration:none" target="_blank">Unsubscribe</a> form this email.</td>
              </tr>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px">Resume2Work, Inc. © All Rightss Reserved Worldwide</td>
              </tr>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px">#000 Street, City, Country, Zip code.</td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</center>
</body>
</html>    	
HTML;
    }
 public function getForgotEmailContent($data)
 {

 	return <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Resume to work</title>
<style>
/* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
#outlook a {
	padding: 0;
} /* Force Outlook to provide a "view in browser" message */
.ReadMsgBody {
	width: 100%;
}
.ExternalClass {
	width: 100%;
} /* Force Hotmail to display emails at full width */
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
	line-height: 100%;
} /* Force Hotmail to display normal line spacing */
body, table, td, p, a, li, blockquote {
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
} /* Prevent WebKit and Windows mobile changing default text sizes */
table, td {
	mso-table-lspace: 0pt;
	mso-table-rspace: 0pt;
} /* Remove spacing between tables in Outlook 2007 and up */
img {
	-ms-interpolation-mode: bicubic;
} /* Allow smoother rendering of resized image in Internet Explorer */
/* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
body {
	margin: 0;
	padding: 0;
}
img {
	border: 0;
	height: auto;
	line-height: 100%;
	outline: none;
	text-decoration: none;
}
a:hover {
	color: #0b87cf;
}
 @media screen and (min-width: 601px) {
 .container {
 width: 600px!important;
}
}
 @media screen and (max-width: 525px) {
	/* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
	body, table, td, p, a, li, blockquote {
 -webkit-text-size-adjust: none !important;
} /* Prevent Webkit platforms from changing default text sizes */
 body {
 width: 100% !important;
 min-width: 100% !important;
} /* Prevent iOS Mail from adding padding to the body */
 table {
 width: 100% !important;
 max-width: 100% !important;
 text-align: left !important;
}
}
</style>
</head>
 	
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" offset="0">
<center>
  <!-- //Header Outer Table -->
  <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f2f2f2" style="padding: 10px 10px 0; font-family: 'Helvetica', Arial, sans-serif; font-size: 14px;">
    <tr>
      <td align="center" valign="top"><!-- //Header post Table -->
 	
        <table class="container" cellpadding="0" cellspacing="0" border="0"0 style="max-width: 600px; width: 100%; background:#ffffff; border: solid 1px #cccccc;">
          <tr>
            <td style="text-align: center; vertical-align: top; width: 100%;"><table cellspacing="0" cellpadding="0" style="background:#ffffff;width:100%; padding: 20px 20px 10px;">
                <tr>
                  <td align="left"><h2 style="font-weight: 300; color: #666666; margin: 0px;">Resume2Work</h2></td>
                  <td align="right"><a href="https://resumes2work.com" style="background: #f1f1f1; display: inline-block; padding: 5px 10px; color:#555555; text-decoration: none; border: solid 1px #aaa;">Sign In</a></td>
                </tr>
              </table>
              <hr color="#CCCCCC" size="1" />
              <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; padding-left: 20px; padding-right: 20px; padding-bottom: 20px;">
                <tr>
                  <td align="left" style="font-size:15px;font-weight:normal" colspan="2">
                  <p style="line-height:1.6;color:#555555;"> Hi {$data['name']},</p>
 	
                     <p style="line-height:1.6; margin-bottom:0; color:#555555;"> Follow the below steps to reset your password.</p>
                   </td>
                </tr>
                <tr>
                	<td  align="left">
                    <table width="100%" bgcolor="#efefef" style="margin: 15px 0; padding: 0 10px 10px;border: solid 1px #cccccc;">
                    <tr>
                    <td>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;"><strong>Your Login information</strong></p>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;">Username: {$data['email']} </p>
                      <p style="line-height:1.2; margin-bottom:0;color:#555555;"><a href="{$data['resetLink']}" style="color:#039">Click here</a> to reset your password</p>
                    </td>
                    </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                	<td align="left">
           
                     <p style="line-height:1.6; margin-bottom:0; color:#555555;">Our promise</p>
 	
                    <ul style="line-height:1.6; margin-bottom:0; color:#555555;">
                      <li>We'll never sell/share your personal info to 3rd parties, except those you authorize</li>
                      <li>We never charge you to find a job. If you are prompted to pay an application or screening fer a job you found throuh Resume2Work, please let us know immediately.</li>
                    </ul>
                    </td>
                    </tr>
                    <tr>
                    <td align="left">
                    <hr color="#CCCCCC" size="1" />
                    <p style="line-height:1.6; margin-bottom:0; color:#555555;"><strong>Good luck in your job search!</strong></p>
                    <p style="line-height:1.6; margin-bottom:0; color:#555555;">- The Resume2Work team</p>
                    </td>
                </tr>
              </table></td>
          </tr>
        </table>
 	
        <!-- Header post Table //--></td>
    </tr>
  </table>
  <table cellspacing="0" cellpadding="0" align="center" style="width:100%;background:#f2f2f2">
    <tbody>
      <tr>
        <td align="center" style="padding:20px 0 10px 0"><table class="container" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background:#f2f2f2;">
            <tbody>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px"> <a href="#" style="color:#1283b3;text-decoration:none" target="_blank">Unsubscribe</a> form this email.</td>
              </tr>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px">Resume2Work, Inc. © All Rightss Reserved Worldwide</td>
              </tr>
              <tr>
                <td align="center" style="padding:0 10px 10px 10px;font-size:10px">#000 Street, City, Country, Zip code.</td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</center>
</body>
</html>
HTML;
 	
 }

}