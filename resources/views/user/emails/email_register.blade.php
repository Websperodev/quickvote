<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6em;
    margin: 0;
}

body {
    background-color: #f6f6f6;
}

@media only screen and (max-width: 640px) {
body {
    padding: 0 !important;
}

h1 {
    font-weight: 800 !important;
    margin: 20px 0 5px !important;
}

h2 {
    font-weight: 800 !important;
    margin: 20px 0 5px !important;
}

h3 {
    font-weight: 800 !important;
    margin: 20px 0 5px !important;
}

h4 {
    font-weight: 800 !important;
    margin: 20px 0 5px !important;
}

h1 {
    font-size: 22px !important;
}

h2 {
    font-size: 18px !important;
}

h3 {
    font-size: 16px !important;
}
.container {
    padding: 0 !important;
    width: 100% !important;
}
.content {
    padding: 0 !important;
}
.content-wrap {
    padding: 10px !important;
}
.invoice {
    width: 100% !important;
}
}
a.Verify-btn {
   /* background: linear-gradient(to right,#9d3aba,#e51197) !important;*/
    border: 0;
    /*border-radius: 30px;*/
    padding: 10px 30px;
    /*color: #fff;*/
    text-decoration: none;
    font-weight: 600;
    text-align: center;
    display: inline-block;
    margin-bottom: 10px;
}
a.email-temp {
    color: #df159a;
}
td.content-block {
    font-size: 16px !important;
    /* font-family: open sans !important; */
    text-align: center;
}
.site-logo img {
    margin-bottom: 0px;
    max-width: 400px;
}
td.site-logo {
    text-align: center;
    margin-bottom: 40px !important;
}
td.footer-txt {
    text-align: center;
    font-size: 16px;
    color: #e21399;
}
.header {
    background: #f6f6f6;
    padding: 10px 0;
    max-width: 590px;
    margin:0 auto;
}
.footer-txt {
    font-size: 16px;
    text-align: center;
    color: #fff;
}
.site-logo {
    text-align: center;
}
.footer {
    background: #000;
    padding: 15px 0;
    max-width: 590px;
    margin: 0px auto 0;
}
.top-footer {
    background: #222222;
    padding: 0px 0;
    max-width: 590px;
    margin: 0px auto 0;
    align-items: center;
    display: flex;
}

.social-nav a {
    width: 35px;
    text-align: center;
    line-height: 35px;
    border-radius: 100%;
    border: 1px solid #fff;
    background-color: #fff;
    display: inline-block;
    color: #222;
    margin-right: .75rem;
    height: 35px;
    font-weight: bold;
    font-size: 22px;
}
.social-nav li {
    display: inline-block;
}
.social-nav i.fa{
    padding-top: 7px;
}
.terms li {
    font-size: 16px;
    color: #fff;
    display: inline-block;
    padding: 0 2px;
}
.top-footer .col-sm-6 {
    display: inline-block;
    width: 48%;
}
.terms a {
    font-size: 16px;
    text-align: center;
    color: #fff;
    text-decoration: none;
}
.welcome img {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    display: block;
}
.content{
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; 
    box-sizing: border-box; 
    font-size: 14px; 
    -webkit-font-smoothing: antialiased; 
    -webkit-text-size-adjust: none; 
    width: 100% !important; 
    height: 100%; 
    line-height: 1.6em; 
    background-color: #fff; 
    margin: 0 auto;
    text-align: center;
    max-width: 590px;
    text-align: center;
    padding-top: 30px;
}
.content .username{
    font-size: 20px !important;
    margin: 0;
    padding: 0 0 20px;
    text-transform: capitalize;
}
.content p{
    font-size: 16px !important;
    text-align: center;
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
}
.content p.regards{
    padding: 0 0 0px;
}
.content a.email-temp {
    color: #df159a;
}
.templateColumnContainer2{
    float: left;
    width: 48%;
}
td{
    display: inline-block;
}
</style>
</head>

<body>
    <table align="center" class="content" style="background: #fff; margin: 20px auto 30px ; text-align: center; max-width: 590px; width: 590px; text-align: center; padding-top: 20px; display: block;">
    <tr style="text-align:center; display: block; width: 590px; margin: 0 auto;">
          <h2> Confirm Your Email Address</h2>
           
           <p>Tap the button below to confirm your email address. If you didn't create an account with Quickvote, you can safely delete this email.</p>
           <a href="<?php echo $link;?>">Confirm Email</a>
           <p>If that doesn't work, copy and paste the following link in your browser:</p>
            <a href="javascript:void(0);"><?php echo $link;?></a>
    </tr>
     
      </table>

</body>
</html>
