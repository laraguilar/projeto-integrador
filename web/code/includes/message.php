<?php
//Sessão
session_start();
if(isset($_SESSION['mensagem'])):?>
    <script>
    // Mensagem se o cadastro da empresa foi efetuado
    window.onload = function() {
        M.toast({html: '<?php echo $_SESSION['mensagem']?>'})
    };
</script>
<?php
endif;
session_unset();