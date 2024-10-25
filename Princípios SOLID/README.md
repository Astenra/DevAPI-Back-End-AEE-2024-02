# Sistema de Emissão de Nota Fiscal

Este projeto é um sistema básico de emissão de notas fiscais desenvolvido em PHP, com o objetivo de demonstrar a aplicação dos princípios S.O.L.I.D para tornar o código mais modular, extensível e fácil de manter.

## Objetivo

Demonstrar a aplicação dos princípios S.O.L.I.D em um projeto de software para promover um código mais limpo, modular e de fácil manutenção.

## Princípios S.O.L.I.D Aplicados

O sistema foi desenvolvido inicialmente sem os princípios S.O.L.I.D e, posteriormente, refatorado para aplicá-los. Abaixo estão as mudanças feitas e como cada princípio foi aplicado para melhorar a qualidade do código.

### Princípio de Responsabilidade Única (SRP)

- **Mudança**: Dividimos a classe `NotaFiscal` em várias classes específicas para cada responsabilidade.
  - `NotaFiscal`: Responsável apenas pela geração da nota fiscal.
  - `ImpostoFixo`: Responsável pelo cálculo do imposto.
  - `EmailService`: Responsável pelo envio de e-mails.
  
- **Benefício**: Cada classe agora possui uma única responsabilidade, o que facilita a leitura e manutenção do código.

### Princípio Aberto/Fechado (OCP)

- **Mudança**: Foi criada uma interface `ImpostoInterface`, permitindo adicionar novos cálculos de imposto sem modificar a classe `NotaFiscal`.

- **Benefício**: A `NotaFiscal` agora está aberta para extensão, mas fechada para modificações, permitindo adicionar novos tipos de cálculo de imposto (por exemplo, `ImpostoProporcional`) sem alterar sua lógica interna.

### Princípio de Substituição de Liskov (LSP)

- **Mudança**: `NotaFiscal` depende da interface `ImpostoInterface`, permitindo substituir implementações específicas de cálculo de imposto.

- **Benefício**: O uso de uma interface para o cálculo de imposto permite que `NotaFiscal` substitua qualquer implementação de `ImpostoInterface` sem quebrar a lógica do sistema.

### Princípio de Segregação de Interfaces (ISP)

- **Mudança**: Criamos a interface `NotaFiscalInterface` para a `NotaFiscal`, que agora implementa um contrato específico.

- **Benefício**: Outras classes podem implementar essa interface se precisarem seguir a mesma estrutura, promovendo um design mais modular e flexível.

### Princípio de Inversão de Dependência (DIP)

- **Mudança**: `NotaFiscal` agora depende de abstrações (`ImpostoInterface` e `EmailService`), em vez de implementações concretas.

- **Benefício**: O código é agora mais testável e modular, uma vez que a `NotaFiscal` não está mais acoplada a implementações específicas, facilitando a substituição e reutilização de classes.

## Benefícios Gerais da Refatoração

- **Modularidade e Extensibilidade**: A arquitetura agora permite a adição de novos tipos de cálculos de imposto e métodos de envio de e-mail sem modificações nas classes principais.
- **Testabilidade**: O uso de interfaces permite a criação de mocks para testes de unidade, aumentando a confiabilidade e qualidade do código.
- **Facilidade de Leitura e Manutenção**: Cada classe possui uma responsabilidade única, tornando o código mais fácil de entender e reduzindo o risco de erros.

## Estrutura do Código

- `NotaFiscal`: Classe principal responsável pela geração de notas fiscais.
- `ImpostoInterface`: Interface para cálculo de imposto.
- `ImpostoFixo`: Implementação de imposto fixo de 10%.
- `EmailService`: Serviço para envio de e-mails.

## Exemplo de Uso

```php
$itens = [
    ["nome" => "Produto A", "preco" => 50.00, "quantidade" => 2],
    ["nome" => "Produto B", "preco" => 100.00, "quantidade" => 1]
];

$impostoService = new ImpostoFixo();
$emailService = new EmailService();
$notaFiscal = new NotaFiscal("Cliente 1", $itens, $impostoService, $emailService);
$notaFiscal->gerarNotaFiscal();
