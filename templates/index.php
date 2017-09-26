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
                <div class="col-md-12"><h4><a href="index2.php">Second Part</a></h4></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="error"><?php echo isset($error) ? $error: '';?></p>
                    <p>Receiving exchange rates on a certain date (daily exchange rates)</p>
                    <form action="index.php" method="post" class="form">
                        <div class="form-group">
                            <p>
                                <input type="text" name="date" class="custom-file-input"id="datetimepicker" placeholder="Choose date">
                            </p>
                            <p>Choose type:</p>
                            Soap
                            <input type="checkbox" name="type" value="soap">
                            Curl
                            <input type="checkbox" name="type" value="curl">
                            <p>
                                <button class="btn btn-info">Send</button>
                            </p>
                        </div>
                    </form>
                
                
                    <?php 
                        if (!empty($curs)) 
                        { ?>
                        <p><b>Exchange rates for( <?php echo $_POST['date'];?> )</b></p>
                        <ul>
                            <?php foreach ($curs as $item) 
                            { ?>
                                <li>Name:   <?php echo $item->Vname;?>  </li>
                                <li>Nom:    <?php echo $item->Vnom;?>   </li>
                                <li>Curs:   <?php echo $item->Vcurs;?>  </li>
                                <li>Code:   <?php echo $item->Vcode;?>  </li>
                                <li>ChCode: <?php echo $item->VchCode;?></li>
                                <hr>
                            <?php } ?>
                        </ul>
                           
                        <?php }
                    ?>
               </div>
            </div>
        </div>
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="<?php echo PATH;?>js/bootstrap.min.js"></script>
         <script type="text/javascript" src="<?php echo PATH;?>js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo PATH;?>js/bootstrap-datetimepicker.ru.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format: 'yyyy-mm-dd',
                    pickTime: false,
                    startView: 'month',
                    minView: 'month',
                    autoclose: true 
                });
            });
        </script>
    </body>
</html>

