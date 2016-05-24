<?php

namespace Application\Util;

use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class EmailUtil {
	
	private $from ='webmaster@gohire.com'; 
	
	public function sendEmail($to,$subject, $content, $is_html = true) {
		$html = new MimePart ( $content );
		if ($is_html) {
			$html->type = "text/html";
		}
		
		$body = new MimeMessage ();
		$body->setParts ( array (
				$html 
		) );
		
		$mail = new \Zend\Mail\Message ();
		$mail->setBody ( $body );
		$mail->setFrom ( $this->from );
		$mail->addTo ( $to );
		$mail->setSubject ( $subject );
		
		$transport = $this->getTransport();
		return $transport->send ( $mail );
	}
	public function getTransport($mailer='smtp')
	{
		if($mailer=='smtp'){
			$smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
			$smtpOptions->setHost('email-smtp.us-west-2.amazonaws.com')
			->setConnectionClass('login')
			->setName('email-smtp.us-west-2.amazonaws.com')
			->setPort(587)
			->setConnectionConfig(array(
					'username' => 'AKIAIRGYH5D4KQRT2JCQ',
					'password' => 'Aqqj3evKO+aUcse39529tvWUdfR+fF+h4F00WmqVcqBZ',
					'ssl' => 'tls',
			
			));
			
			$transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
		}else if($mailer=='sendmail'){
			$transport = new \Zend\Mail\Transport\Sendmail ();
		}
		
		return $transport;
		
	}
}