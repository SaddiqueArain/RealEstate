<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Real Estate Builders Free Responsive Website Templates - icon">
	<meta name="author" content="webThemez.com">
	<title>Fahad Builders and Traders</title>
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<?php echo link_tag('home/assets/css/bootstrap.min.css')?>
	<?php echo link_tag('home/assets/css/font-awesome.min.css')?> 
	<?php echo link_tag('home/assets/css/bootstrap-theme.css')?>  
	<?php echo link_tag('home/assets/css/style.css')?>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('home/assets/css/isotope.css');?>" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url('home/assets/js/fancybox/jquery.fancybox.css');?>" type="text/css" media="screen" />
    <link rel='stylesheet' id='camera-css'  href="<?php echo base_url('home/assets/css/camera.css');?>" type='text/css' media='all'> 
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="<?php echo base_url('assets/bower/jquery/dist/jquery.min.js');?>"></script>
 
  <style type="text/css">

.navbar {
  overflow: hidden;
  background-color: aqua;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

select{
  background-color: yellow !important;
}
.dropdown {
  float: left;
  overflow: hidden;
}
.input-group
{
  background-color: yellow;
}
.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: purple;
  transition: 0.5s !important;
  
}

.dropdown-content {
  display: none;
  background-color: #f9f9f9;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

.dropdown:hover .dropdown-content {
  
}
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.check
{
  width: 20px;
  height: 20px;
}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
  background-color:white; 
  
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.card-body{
  padding: 5px 8px;
}
.card-block
{
  width:100%;min-width:auto;height:2px;background-color:#aaa;position:absolute;left:-1px
}

.category{width: 30%;
    font-weight: 300;}.value{width: 70%;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;} .left{float: left;}.right{float: right;}
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  margin-left: 100px;
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 50%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

  </style>

</head>
<body>
	<!-- Fixed navbar -->
  
