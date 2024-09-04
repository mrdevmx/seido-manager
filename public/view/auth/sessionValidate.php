<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $pathTemplate.'view/template/head.php'?>
</head>
<body>
    <?php include $pathTemplate.'view/template/loader.php'?>
    <?php include $pathTemplate.'view/template/scripts.php'?>
</body>
<script>
    $(document).ready(function(){
        var path = '<?php echo $pathprincipal;?>';
        if('<?php echo $pathprincipal;?>' != ''){
            window.location.href = "./<?php echo $pathprincipal;?>";
        }else{
            console.log('<?php echo $pathprincipal;?>');
        }
    });
</script>
</html>