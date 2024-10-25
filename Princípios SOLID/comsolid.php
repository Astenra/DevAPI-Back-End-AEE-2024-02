<?php

// 1. Interface de Nota Fiscal (ISP)
interface NotaFiscalInterface {
    public function gerarNotaFiscal();
}

// 2. Responsabilidade Única (SRP) - Classe responsável pela Nota Fiscal
class NotaFiscal implements NotaFiscalInterface {
    private $cliente;
    private $itens = [];
    private $impostoService;
    private $emailService;

    public function __construct($cliente, array $itens, ImpostoInterface $impostoService, EmailService $emailService) {
        $this->cliente = $cliente;
        $this->itens = $itens;
        $this->impostoService = $impostoService;
        $this->emailService = $emailService;
    }

    public function gerarNotaFiscal() {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $totalComImposto = $this->impostoService->calcularImposto($total);

        // Exibe a nota fiscal
        echo "Cliente: " . $this->cliente . PHP_EOL;
        echo "Total (com imposto): R$ " . number_format($totalComImposto, 2) . PHP_EOL;

        $this->emailService->enviarEmail($this->cliente, $totalComImposto);
    }
}

// 3. Princípio Aberto/Fechado (OCP) - Interface de Imposto
interface ImpostoInterface {
    public function calcularImposto($valor);
}

// 4. Classe de Cálculo de Imposto Fixo (implementação de ImpostoInterface)
class ImpostoFixo implements ImpostoInterface {
    private $taxa = 0.1; // imposto de 10%

    public function calcularImposto($valor) {
        return $valor + ($valor * $this->taxa);
    }
}

// 5. Serviço de envio de e-mails para separação de responsabilidade (SRP)
class EmailService {
    public function enviarEmail($cliente, $valorTotal) {
        // Simulação de envio de e-mail
        echo "Enviando e-mail para " . $cliente . " com o valor de R$ " . number_format($valorTotal, 2) . PHP_EOL;
    }
}

// Uso
$itens = [
    ["nome" => "Produto A", "preco" => 50.00, "quantidade" => 2],
    ["nome" => "Produto B", "preco" => 100.00, "quantidade" => 1]
];

$impostoService = new ImpostoFixo();
$emailService = new EmailService();
$notaFiscal = new NotaFiscal("Cliente 1", $itens, $impostoService, $emailService);
$notaFiscal->gerarNotaFiscal();
