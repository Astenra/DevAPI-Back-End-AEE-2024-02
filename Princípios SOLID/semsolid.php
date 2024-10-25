<?php

class NotaFiscal {
    private $cliente;
    private $itens = [];
    private $imposto;

    public function __construct($cliente, $itens) {
        $this->cliente = $cliente;
        $this->itens = $itens;
        $this->imposto = 0.1; // imposto fixo de 10%
    }

    public function gerarNotaFiscal() {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $totalComImposto = $total + ($total * $this->imposto);

        // Exibe a nota fiscal
        echo "Cliente: " . $this->cliente . PHP_EOL;
        echo "Total (com imposto): R$ " . number_format($totalComImposto, 2) . PHP_EOL;

        $this->enviarEmail($this->cliente, $totalComImposto);
    }

    private function enviarEmail($cliente, $valorTotal) {
        // Simulação de envio de e-mail
        echo "Enviando e-mail para " . $cliente . " com o valor de R$ " . number_format($valorTotal, 2) . PHP_EOL;
    }
}

// Uso
$itens = [
    ["nome" => "Produto A", "preco" => 50.00, "quantidade" => 2],
    ["nome" => "Produto B", "preco" => 100.00, "quantidade" => 1]
];

$notaFiscal = new NotaFiscal("Cliente 1", $itens);
$notaFiscal->gerarNotaFiscal();
