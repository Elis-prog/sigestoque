<?php
if(isset($_SESSION['message'])){
    ?>
    <script>
  swal({
    title: "<?= $_SESSION['message']; ?>",
    //text: "Hello world!",
    icon: "<?= $_SESSION['icomessage']; ?>",
});
</script>




<?php
unset($_SESSION['message']);
}

?>

<!--  -->