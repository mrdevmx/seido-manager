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
        if( path != ''){
            window.location.href = "./"+path;
        }else{
            console.log(path);
        }
    });
</script>
</html>