<?php
    
    session_start();

    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
    }

?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja virtual - PHP</title>

    <link rel="stylesheet" href="css/estilos.css">

</head>
<body>

    <header>

        <h1>Loja virtual</h1>

    </header>

    <main>

        <div class="container">

            <?php

            $itens = array( ['nome'=> 'curso 1','imagens'=>'imagens/item1.jpg','preco'=>'200'],
                            ['nome'=> 'curso 2','imagens'=>'imagens/item2.jpg','preco'=>'100'],
                            ['nome'=> 'curso 3','imagens'=>'imagens/item3.png','preco'=>'400']
                        );
                        
            foreach ($itens as $key => $value){
           
            ?>

                <div class="produto">

                    <img src="<?php echo $value['imagens']?>" alt=""/>

                    <p><b><?php echo $value['nome']?> - R$ <?php echo $value['preco']?>,00</b></p>

                    <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho</a>

                    <a href="?remover=<?php echo $key ?>">Remover do carrinho</a>

                </div>   

            <?php

            }

            ?>

        </div>
            
            <?php

            if(isset($_GET['remover'])){
                /* adicionar ao carrinho */
                $idProduto = (int) $_GET['remover'];
                if(isset($itens[$idProduto])){
                    /* echo 'o produto existe'; */
                    if(isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto]['quantidade']--;
                    }else{
                        $_SESSION['carrinho'][$idProduto] = array('quantidade'=>1,'nome'=> $itens[$idProduto]['nome'],'preco'=> $itens[$idProduto]['preco']);
                    }
                    echo "<script> alert('O item foi removido ao carrinho.'); </script>";
                }else{
                    echo "<script> alert('Você não poode remover este item ao carrinho - produto não existe.'); </script>";
                }
            } 

            ?>

            <?php

            if(isset($_GET['adicionar'])){
                /* adicionar ao carrinho */
                $idProduto = (int) $_GET['adicionar'];
                if(isset($itens[$idProduto])){
                    /* echo 'o produto existe'; */
                    if(isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto]['quantidade']++;
                    }else{
                        $_SESSION['carrinho'][$idProduto] = array('quantidade'=>1,'nome'=> $itens[$idProduto]['nome'],'preco'=> $itens[$idProduto]['preco']);
                    }
                    echo "<script> alert('O item foi adicionado ao carrinho.'); </script>";
                }else{
                    echo "<script> alert('Você não poode adicionar este item ao carrinho - produto não existe.'); </script>";
                }
            } 

            ?>

        <div class="carrinho">

            <h1>Itens do carrinho</h1>

        </div>

           

            <?php

                foreach ($_SESSION['carrinho'] as $key => $value){
                    
                    echo '<div class="itenscarrinho">';
                
                    /* echo ('Nome: '.$value['nome'].'  |   Quantidade: '.$value['quantidade'].'  |   Preco: '.$value['preco']. '  |   Total: '.$value['quantidade']*$value['preco']); */

                    echo '<p> Nome: '.$value['nome'].'  |   Quantidade: '.$value['quantidade'].'  |   Preco: '.$value['preco']. '  |   Total: '.$value['quantidade']*$value['preco']; '</p>';

                    echo '</div>';


                }
          
            ?>

    </main>

    <footer class="fixarRodape">

    <h1><a href="index.php">Voltar a pagina principal</a></h1>

    </footer>
    
</body>
</html>