<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura - Ngestor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Cabeçalho -->
            <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-blue-800">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-white">NGESTOR</h1>
                        <p class="text-blue-100 mt-1">Integração Inteligente para Gestão Empresarial</p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-xl font-semibold text-white">FATURA</h2>
                        <p class="text-blue-100">#NGT-2024-001</p>
                    </div>
                </div>
            </div>

            <!-- Informações -->
            <div class="px-8 py-6">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-gray-600 font-semibold mb-2">DE</h3>
                        <p class="font-medium">Ngestor Solutions</p>
                        <p class="text-gray-600">CNPJ: XX.XXX.XXX/0001-XX</p>
                        <p class="text-gray-600">contato@ngestor.com.br</p>
                        <p class="text-gray-600">+55 (11) XXXX-XXXX</p>
                    </div>
                    <div>
                        <h3 class="text-gray-600 font-semibold mb-2">PARA</h3>
                        <p class="font-medium">[Nome do Cliente]</p>
                        <p class="text-gray-600">CNPJ: [CNPJ do Cliente]</p>
                        <p class="text-gray-600">[Email do Cliente]</p>
                        <p class="text-gray-600">[Telefone do Cliente]</p>
                    </div>
                </div>

                <!-- Detalhes da Fatura -->
                <div class="mt-8">
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Unitário</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-900">Módulo de Integração ERP</p>
                                            <p class="text-sm text-gray-500">Licença mensal - Plano Business</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-900">1</td>
                                    <td class="px-6 py-4 text-right text-gray-900">R$ 297,00</td>
                                    <td class="px-6 py-4 text-right text-gray-900">R$ 297,00</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-900">Suporte Premium</p>
                                            <p class="text-sm text-gray-500">Atendimento prioritário 24/7</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-900">1</td>
                                    <td class="px-6 py-4 text-right text-gray-900">R$ 97,00</td>
                                    <td class="px-6 py-4 text-right text-gray-900">R$ 97,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Resumo -->
                <div class="mt-8 flex justify-end">
                    <div class="w-80">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">R$ 394,00</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Desconto</span>
                            <span class="font-medium text-green-600">- R$ 39,40</span>
                        </div>
                        <div class="flex justify-between py-2 border-t border-gray-200">
                            <span class="text-lg font-semibold">Total</span>
                            <span class="text-lg font-bold text-blue-600">R$ 354,60</span>
                        </div>
                    </div>
                </div>

                <!-- Informações de Pagamento -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informações de Pagamento</h3>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Banco:</span> XXX - Banco XXXXX</p>
                        <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Agência:</span> XXXX</p>
                        <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Conta:</span> XXXXX-X</p>
                        <p class="text-sm text-gray-600"><span class="font-medium">PIX:</span> CNPJ XX.XXX.XXX/0001-XX</p>
                    </div>
                </div>

                <!-- Observações -->
                <div class="mt-8 text-sm text-gray-500">
                    <p>Observações:</p>
                    <ul class="list-disc list-inside mt-2">
                        <li>Fatura válida por 5 dias úteis</li>
                        <li>Em caso de dúvidas, entre em contato com nosso suporte</li>
                        <li>Após confirmação do pagamento, o acesso será liberado em até 24 horas</li>
                    </ul>
                </div>
            </div>

            <!-- Rodapé -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                <div class="text-center text-gray-600 text-sm">
                    <p>Ngestor Solutions - Integração Inteligente para Gestão Empresarial</p>
                    <p class="mt-1">www.ngestor.com.br</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 