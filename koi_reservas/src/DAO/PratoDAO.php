<?php

require_once __DIR__ . "/../Conexao/Conexao.php";

class PratoDAO
{

    private $con = null;

    public function getCon()
    {
        if ($this->con === null) {
            $bd = new Conexao();
            $this->con = $bd->getMysqli();
        }
        return $this->con;
    }

    public function getDescon()
    {
        if ($this->con !== null) {
            $this->con->close();
            $this->con = null;
        }
    }

    public function salvarPrato(Prato $prato)
    {

        $pasta = __DIR__ . "/../../img_pratos/";

        $foto = $prato->getFoto();

        $nomeArquivo = time() . '_' . basename($foto['name']);

        $caminhoFinal = $pasta . $nomeArquivo;

        if (!move_uploaded_file($foto['tmp_name'], $caminhoFinal)) {
            echo "Erro ao mover a imagem!";
            return false;
        }

        $caminhoBanco = "img_pratos/" . $nomeArquivo;

        $sql = "INSERT INTO tb_prato(nome, preco, descricao, foto) 
            VALUES('{$prato->getNome()}', {$prato->getPreco()}, '{$prato->getDescricao()}', '{$caminhoBanco}')";

        $con = $this->getCon();
        if (!$con->query($sql)) {
            echo "Erro ao salvar no banco: " . $con->error;
            return false;
        }

        return true;
    }

    public function listarPratos()
    {
        $con = $this->getCon();
        $sql = "SELECT * FROM tb_prato ORDER BY nome ASC";
        $result = $con->query($sql);

        $pratos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $prato = new Prato();
                $prato->setId($row['id_prato']);
                $prato->setNome($row['nome']);
                $prato->setDescricao($row['descricao']);
                $prato->setPreco($row['preco']);
                $prato->setFoto($row['foto']);
                $pratos[] = $prato;
            }
        }
        return $pratos;
    }

    public function excluirPrato($id)
    {
        $con = $this->getCon();

        $id = intval($id);

        $sql = "DELETE FROM tb_prato WHERE id_prato = $id";

        if ($con->query($sql)) {
            return true;
        } else {
            echo "Erro ao excluir prato";
            return false;
        }
    }

    public function alterarPrato($prato)
    {
        $con = $this->getCon();

        $id = intval($prato->getId());
        $nome = $prato->getNome();
        $preco = $prato->getPreco();
        $descricao = $prato->getDescricao();
        $foto = $prato->getFoto();

        $sql = "UPDATE tb_prato 
            SET nome = '$nome', preco = $preco, descricao = '$descricao', foto = '$foto' 
            WHERE id_prato = $id";

        if ($con->query($sql)) {
            return true;
        } else {
            echo "Erro ao atualizar prato: " . $con->error;
            return false;
        }
    }



}



