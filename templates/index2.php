<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Geeksforless -  Soap</title>

        <!-- Bootstrap -->
        <link href="<?php echo PATH;?>css/bootstrap.min.css" rel="stylesheet">

        <!-- My style -->
        <link href="<?php echo PATH;?>css/style.css" rel="stylesheet">
        <link href="<?php echo PATH;?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container mt-50">
        	<div class="row">
        		<div class="col-md-12"><h4><a href="index.php">First Part</a></h4></div>
        	</div>
            <div class="row">
            	<p class="error"><?php echo isset($error) ? $error: '';?></p>
                <p>Public Web Service functions for Visual DataFlex football pool</p>
                <div class="col-md-6">

                    <?php if(!empty($soap_teams)) 
                    {?>
                       <?php foreach ($soap_teams as $item) 
                            { ?>
                                <li>Id:   <?php echo $item->iId;?>  </li>
                                <li>Name:    <?php echo $item->sName;?>   </li>
                                <li>Country flag:   <img src="<?php echo $item->sCountryFlag;?>">  </li>
                                <li>Wikipedia URL:  <a href="<?php echo $item->sWikipediaURL;?>">wiki</a></li>
                                <hr>
                        <?php } ?>

                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <?php if(!empty($curl_teams)) 
                    {?>
                       <?php foreach ($curl_teams as $item) 
                            { ?>
                                <li>Id:   <?php echo $item->miId;?>  </li>
                                <li>Name:    <?php echo $item->msName;?>   </li>
                                <li>Country flag:   <img src="<?php echo $item->msCountryFlag;?>">  </li>
                                <li>Wikipedia URL:  <a href="<?php echo $item->msWikipediaURL;?>">wiki</a></li>
                                <hr>
                        <?php } ?>

                    <?php } ?>
               </div>
            </div>
        </div>
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="<?php echo PATH;?>js/bootstrap.min.js"></script>
    </body>
</html>

