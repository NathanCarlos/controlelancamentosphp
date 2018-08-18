<?php
//Sessão
session_start();
?>
<?php
if(!isset($_SESSION['mensagem'])){
    $_SESSION['mensagem'] = "";
}
?>
<?php
if($_SESSION['mensagem'] != ""):?>	
<script>
	window.onload = function() 
	{
		  M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'});
	};
</script>
<?php
endif;
$_SESSION['mensagem'] = "";
?>