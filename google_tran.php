
<head>
<style type="text/css">
.bounce-1 {
animation-name: bounce-1;
animation-timing-function: linear;
animation-duration: 2s;
animation-iteration-count: infinite;
}
@keyframes bounce-1 {
0%   { transform: translateY(0); }
50%  { transform: translateY(-25px); }
100% { transform: translateY(0); }
}
.scroll-to-top2 {
    position: fixed;
    bottom: 120px;
    /*left: 15px;*/
	right: 12px;
    text-align: center;
    z-index: 100;
	background-color:light-blue;
}
@media screen and (max-width: 768px) {
	.scroll-to-top2{
		bottom: 87px;
	}
	
}
@media screen and (max-width: 568px) {
	.scroll-to-top2{
		bottom: 87px;
	}
}
	
</style>
<link href="css/googletrancss.css" rel="stylesheet">	
</head>

<body>

	<div class="scroll-to-top2" data-target="html"><?php include ('google_translator.php'); ?></div>	

</body>
