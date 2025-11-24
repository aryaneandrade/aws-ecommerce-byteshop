<?php

class Pedido {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registrarPedido($idUsuario, $itensCarrinho, $endereco) {
        try {
            $this->conn->beginTransaction();

            $totalPedido = 0;
            $itensParaSalvar = [];

            // 1. Calcula total e valida produtos
            foreach($itensCarrinho as $idProduto => $qtd) {
                $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id");
                $stmt->bindParam(":id", $idProduto);
                $stmt->execute();
                $prod = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if($prod) {
                    $preco = $prod['preco_promo'];
                    $totalPedido += ($preco * $qtd);
                    $itensParaSalvar[] = ['id_produto' => $idProduto, 'qtd' => $qtd, 'preco' => $preco];
                }
            }

            // 2. Cria o Pedido com Endereço
            $sql = "INSERT INTO pedidos (id_usuario, valor_total, cep, rua, numero, bairro, cidade, estado) 
                    VALUES (:id_usuario, :valor_total, :cep, :rua, :numero, :bairro, :cidade, :estado)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_usuario", $idUsuario);
            $stmt->bindParam(":valor_total", $totalPedido);
            
            // Bind dos dados do endereço
            $stmt->bindParam(":cep", $endereco['cep']);
            $stmt->bindParam(":rua", $endereco['rua']);
            $stmt->bindParam(":numero", $endereco['numero']);
            $stmt->bindParam(":bairro", $endereco['bairro']);
            $stmt->bindParam(":cidade", $endereco['cidade']);
            $stmt->bindParam(":estado", $endereco['estado']);
            
            $stmt->execute();
            $idPedido = $this->conn->lastInsertId();

            // 3. Salva os itens
            $stmtItem = $this->conn->prepare("INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario) VALUES (:id_pedido, :id_produto, :qtd, :preco)");

            foreach($itensParaSalvar as $item) {
                $stmtItem->bindParam(":id_pedido", $idPedido);
                $stmtItem->bindParam(":id_produto", $item['id_produto']);
                $stmtItem->bindParam(":qtd", $item['qtd']);
                $stmtItem->bindParam(":preco", $item['preco']);
                $stmtItem->execute();
            }

            $this->conn->commit();
            return $idPedido;

        } catch(Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function listarPorUsuario($idUsuario) {
        $sql = "SELECT p.*, 
                (SELECT GROUP_CONCAT(CONCAT(pr.nome, ' (x', ip.quantidade, ')') SEPARATOR ', ') 
                 FROM itens_pedido ip 
                 JOIN produtos pr ON ip.id_produto = pr.id 
                 WHERE ip.id_pedido = p.id) as resumo_itens
                FROM pedidos p 
                WHERE p.id_usuario = :id_usuario 
                ORDER BY p.data_pedido DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $idUsuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}