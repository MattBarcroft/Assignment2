<h1>User Created Successfully</h1>
<?php 
echo "Welcome ".$_SESSION['username'];
?>
<script>

window.onload = function(){
    window.setTimeout(function(){
        window.location.href = "../../home";
    }, 1000);
};

</script>