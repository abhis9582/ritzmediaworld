<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';                     // Use SMTP protocol
$config['smtp_host'] = 'smtp.gmail.com';          // Gmail SMTP server
$config['smtp_port'] = 587;                       // Port 587 for TLS
$config['smtp_user'] = 'support@ritzmediaworld.com';    //Gmail email address
$config['smtp_pass'] = 'isemvctjqadkgrab';       // Gmail App Password (not regular Gmail password)
$config['smtp_crypto'] = 'tls';                   // TLS encryption
$config['mailtype'] = 'html';                     // Email format: HTML
$config['charset'] = 'utf-8';                     // Character set
$config['wordwrap'] = TRUE;                       // Enable word wrapping
$config['newline'] = "\r\n";                      // Newline character for email header
$config['validation'] = TRUE;                     // Enable validation of the email

// This is to make sure that the email library works with Gmail
