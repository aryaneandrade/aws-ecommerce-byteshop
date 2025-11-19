# 🛒 ByteShop - E-commerce Black Friday

Projeto acadêmico de um sistema de E-commerce completo desenvolvido em **PHP Nativo**, focado na venda de eletrônicos com temática de Black Friday.

O sistema conta com fluxo completo de vendas: Autenticação, Catálogo, Carrinho, Simulação de Frete (API), Checkout, Pagamento via PIX (API) e Histórico de Pedidos.

## 🚀 Funcionalidades

### 👤 Usuário
*   **Autenticação:** Cadastro e Login seguros (senha criptografada).
*   **Painel:** Visualização personalizada ("Olá, Nome").
*   **Meus Pedidos:** Histórico completo de compras com status e detalhes.

### 🛍️ Loja e Produtos
*   **Catálogo:** Listagem dinâmica vinda do banco de dados.
*   **Filtros:** Busca por nome e categorias (Monitores, Celulares, Games).
*   **Preços:** Exibição de preço "De/Por" com cálculo de desconto.

### 🛒 Carrinho e Checkout
*   **Gestão:** Adicionar e remover itens, cálculo automático de subtotal.
*   **API de Frete:** Integração com **ViaCEP** para simular entrega e exibir cidade do cliente.
*   **Validação:** Apenas usuários logados podem fechar o pedido.

### 💳 Pagamento (Simulação)
*   **API de QR Code:** Integração com **QuickChart** para gerar um QR Code PIX dinâmico e exclusivo para cada pedido na tela de sucesso.
*   **Fluxo Realista:** Carrinho -> Finalizar -> Tela de Pagamento (QR Code) -> Confirmação -> Histórico.

## 🛠️ Tecnologias Utilizadas

*   **Back-end:** PHP 7.4+ (PDO).
*   **Banco de Dados:** MySQL / MariaDB.
*   **Front-end:** HTML5, CSS3, JavaScript (Fetch API).
*   **Framework CSS:** Bootstrap 5.3 + Bootstrap Icons.
*   **APIs Externas:**
    *   [ViaCEP](https://viacep.com.br/) (Consulta de endereço).
    *   [QuickChart](https://quickchart.io/) (Geração de QR Code).

## Diagramas do Projeto 

### Diagrama ER 

### Diagrama de Classes


## ⚙️ Instalação e Configuração

### 1. Requisitos
*   Servidor local (XAMPP, WAMP, Laragon ou Apache com PHP).
*   MySQL.

### 2. Banco de Dados
Crie um banco de dados chamado `black_friday` a partir do script localizado em database/banco.sql 
