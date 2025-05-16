<!-- Conteúdo principal com Dashboard -->
<main class="pt-24 pb-28 px-6 sm:px-6 lg:px-8 w-full">
    @php
    setlocale(LC_TIME, 'pt_PT'); // Definindo o local para português
    $data = strftime('%d-%B-%Y'); // Exibe o nome do mês por extenso
    $dataOntem = strftime('%d-%B-%Y', strtotime('-1 day')); // Exibe a data de ontem com o nome do mês
    @endphp
    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="w-full">
            <div class="flex items-center">
                <div class="w-full">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('painel.index', ['page' => 'dashboard-operator']) }}"
                                    class="text-gray-700 hover:text-blue-600">Home</a>
                            </li>
                            <li class="flex items-center">
                                <span class="mx-2 text-gray-400">/</span>
                                <a href="{{ route('painel.index', ['page' => 'dashboard-operator']) }}" class="text-gray-500 hover:text-blue-400">Dashboard</a>
                            </li>
                          
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner de Boas-vindas -->
    <div class="w-full mb-6">
        <div class="bg-gradient-to-r from-blue-900 to-blue-400 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-wrap items-center">
                    <div class="w-full md:w-1/2">
                        <div class="p-4">
                            <h4 class="text-2xl font-bold text-white mb-2">Bem-vindo ao IDPharm Module</h4>
                            <p class="text-white/90">
                                Gestão Inteligente de Vendas e Estoque para Farmácias
                                Uma solução robusta e eficiente para otimizar o controle de vendas, estoque e
                                fornecedores, assegurando a conformidade e a qualidade nos processos.
                                Maximize a performance do seu negócio com confiança.
                            </p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <!-- SVG mantido como está, apenas ajustando classes de container -->
                        <div class="w-full max-w-lg mx-auto">
                            <!-- Adicionando o elemento para a animação -->
                            <div id="welcome-animation" class="h-[200px]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Métodos de Pagamento -->
    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card Dinheiro -->
        <div class="border bg-white rounded-lg shadow-md hover:-translate-y-1 transition-transform duration-200">
            <div class="p-6">
                <h6 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                    <i data-lucide="hand-coins" class="text-green-500"></i> Vendas em Dinheiro
                </h6>
                <div class="h-[60px]" id="sparkline-dinheiro"></div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-gray-900" id="total-vendas-dinheiro">
                            0,00
                        </span>
                        <span class="text-sm font-medium text-gray-600" id="percent-dinheiro">
                            0%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-green-500 h-2.5 rounded-full" id="bar-dinheiro" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card M-pesa -->
        <div class="border bg-white rounded-lg shadow-md hover:-translate-y-1 transition-transform duration-200">
            <div class="p-6">
                <h6 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                    <i data-lucide="tablet-smartphone" class="text-red-500"></i> Vendas M-pesa
                </h6>
                <div class="h-[60px]" id="sparkline-m-pesa"></div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-gray-900" id="total-vendas-m-pesa">
                            0,00
                        </span>
                        <span class="text-sm font-medium text-gray-600" id="percent-m-pesa">
                            0%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-red-500 h-2.5 rounded-full" id="bar-m-pesa" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card E-Mola -->
        <div class="border bg-white rounded-lg shadow-md hover:-translate-y-1 transition-transform duration-200">
            <div class="p-6">
                <h6 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                    <i data-lucide="tablet-smartphone" class="text-yellow-500"></i> Vendas E-Mola
                </h6>
                <div class="h-[60px]" id="sparkline-e-mola"></div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-gray-900" id="total-vendas-e-mola">
                            0,00
                        </span>
                        <span class="text-sm font-medium text-gray-600" id="percent-e-mola">
                            0%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-yellow-500 h-2.5 rounded-full" id="bar-e-mola" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Outros -->
        <div class="border bg-white rounded-lg shadow-md hover:-translate-y-1 transition-transform duration-200">
            <div class="p-6">
                <h6 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-4">
                    <i data-lucide="credit-card" class="text-gray-500"></i> Outros
                </h6>
                <div class="h-[60px]" id="sparkline-outros"></div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-gray-900" id="total-vendas-outros">
                            0,00
                        </span>
                        <span class="text-sm font-medium text-gray-600" id="percent-outros">
                            0%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gray-500 h-2.5 rounded-full" id="bar-outros" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos principais -->
    <div class="grid grid-cols-1 xl:grid-cols-8 gap-6 mt-6">
        <!-- Gráfico de Evolução Mensal -->
        <div class="xl:col-span-5">
            <div class="bg-white rounded-lg shadow-md border">
                <div class="p-6">
                    <h6 class="text-xl  text-gray-900 flex items-center gap-2 mb-4">
                        <i data-lucide="calendar-clock" class="text-blue-500"></i> Performance Semanal
                    </h6>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                        <span class="font-medium">Semana:</span>
                        <span class="bg-gray-50 px-2 py-1 rounded" id="semana-estatisticas"></span>
                    </div>
                    <div id="income-overview-chart"></div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Distribuição -->
        <div class="xl:col-span-3">
            <div class="border bg-white rounded-lg shadow-md">
                <div class="p-6 mb-4">
                    <h6 class="text-xl  text-gray-900 flex items-center gap-2">
                        <i data-lucide="calendar-range" class="text-blue-500"></i> Análise de Métodos de Pagamento
                    </h6>
                    <!-- Ajustando a altura para ser mais responsiva -->
                    <div class="h-[300px] sm:h-[400px] md:h-[400px] lg:h-[400px] mb-6" id="distribuicao-pagamentos"></div>
                </div>
            </div>
        </div>
    </div>



</main>
<!-- End Conteúdo principal com Dashboard -->

<!-- Start Footer com botão de menu -->
@include('components.footer')
<!-- End Footer -->


<script>
var url = "{{ route('dashboard-operator.vendas') }}";
</script>


<script>
// Variáveis globais para armazenar as instâncias dos gráficos
let sparklineCharts = {};
let distributionChart = null;
let monthlyChart = null;
let weeklyChart = null;
let updateInterval = 5000; // 5 segundos

// Função para formatar valores em MZN
function formatMZN(value) {
    if (value === undefined || value === null) {
        console.warn('Valor indefinido ou nulo recebido em formatMZN');
        return '0,00';
    }
    return Number(value).toFixed(2).replace('.', ',');
 
}

// Função para atualizar valor com transição ultra suave
function atualizarValorSuave(elemento, novoValor) {
    const el = $(elemento);
    if (!el.length) {
        console.error(`Elemento não encontrado: ${elemento}`);
        return;
    }
    console.log(`Atualizando ${elemento} com valor: ${novoValor}`);
    el.css('opacity', '0.99')
        .html(novoValor)
        .css('opacity', '1');
}

// Configuração base para sparklines
const sparklineConfig = {
    chart: {
        type: 'area',
        height: 60,
        sparkline: {
            enabled: true
        },
        animations: {
            enabled: true,
            easing: 'linear',
            speed: 1000
        }
    },
    stroke: {
        curve: 'smooth',
        width: 2
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.45,
            opacityTo: 0.05,
            stops: [0, 100]
        }
    },
    tooltip: {
        fixed: {
            enabled: true,
            position: 'right'
        },
        x: {
            show: true,
            formatter: function(value, {
                series,
                seriesIndex,
                dataPointIndex
            }) {
                return dataPointIndex === 0 ? 'Ontem' : 'Hoje';
            }
        },
        y: {
            formatter: formatMZN,
            title: {
                formatter: () => 'Vendas:'
            }
        }
    }
};

// Função para processar dados do sparkline com dados reais
function processarDadosSparkline(vendasHoje, vendasOntem, metodo) {
    //console.log(`Processando dados sparkline para ${metodo}:`, { vendasHoje, vendasOntem });

    const dados = [];

    // Adicionar dados de ontem
    const vendaOntem = vendasOntem ? vendasOntem.find(v => v.metodo_pagamento === metodo) : null;
    dados.push({
        x: 'Ontem',
        y: vendaOntem ? parseFloat(vendaOntem.total_vendas) || 0 : 0
    });

    // Adicionar dados de hoje
    const vendaHoje = vendasHoje ? vendasHoje.find(v => v.metodo_pagamento === metodo) : null;
    dados.push({
        x: 'Hoje',
        y: vendaHoje ? parseFloat(vendaHoje.total_vendas) || 0 : 0
    });

    //console.log(`Dados processados para ${metodo}:`, dados);
    return dados;
}

// Função para inicializar sparklines
function inicializarSparklines() {
    const metodos = ['Dinheiro', 'M-pesa', 'E-Mola', 'Outros'];
    metodos.forEach(metodo => {
        const elementId = metodo === 'Outros' ? 'sparkline-outros' :
            `sparkline-${metodo.toLowerCase()}`;
        const config = {
            ...sparklineConfig,
            colors: [getMetodoColor(metodo)],
            series: [{
                name: 'Vendas',
                data: [0, 0] // Dados iniciais
            }]
        };

        if (!sparklineCharts[elementId]) {
            const element = document.querySelector(`#${elementId}`);
            if (element) {
                sparklineCharts[elementId] = new ApexCharts(element, config);
                sparklineCharts[elementId].render();
            } else {
                console.error(`Elemento não encontrado: #${elementId}`);
            }
        }
    });
}

// Função para obter cor do método
function getMetodoColor(metodo) {
    const cores = {
        'Dinheiro': '#10B981',
        'M-pesa': '#6366F1',
        'E-Mola': '#F59E0B',
        'Outros': '#CBD5E1'
    };
    return cores[metodo] || '#CBD5E1';
}

// Função para atualizar todos os dados
async function atualizarDados() {
    try {
        //console.log('Iniciando atualização de dados...');
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        //console.log('Dados recebidos da API:', data);

        let vendasHoje = {
            'Dinheiro': 0,
            'M-pesa': 0,
            'E-Mola': 0,
            'Outros': 0
        };

        // Processar vendas diárias
        if (data.vendas_diarias && Array.isArray(data.vendas_diarias)) {
            data.vendas_diarias.forEach(venda => {
                if (!venda || !venda.metodo_pagamento || !venda.total_vendas) {
                    //console.warn('Venda inválida:', venda);
                    return;
                }
                const valor = parseFloat(venda.total_vendas);
                if (isNaN(valor)) {
                    //console.warn('Valor inválido:', venda.total_vendas);
                    return;
                }
                if (vendasHoje.hasOwnProperty(venda.metodo_pagamento)) {
                    vendasHoje[venda.metodo_pagamento] += valor;
                } else {
                    vendasHoje['Outros'] += valor;
                }
            });
        }

        // Atualizar cards e sparklines
        Object.entries(vendasHoje).forEach(([metodo, valor]) => {
            // Atualizar card
            const cardId = `#total-vendas-${metodo.toLowerCase()}`;
            const cardElement = document.querySelector(cardId);
            if (cardElement) {
                cardElement.textContent = formatMZN(valor);
            }

            // Atualizar sparkline
            const sparklineId = metodo === 'Outros' ? 'sparkline-outros' :
                `sparkline-${metodo.toLowerCase()}`;
            const chart = sparklineCharts[sparklineId];
            if (chart) {
                const dadosSparkline = processarDadosSparkline(data.vendas_diarias, data.vendas_ontem || [],
                    metodo);
                chart.updateSeries([{
                    name: 'Vendas',
                    data: dadosSparkline.map(d => d.y)
                }]);
            }

            // Atualizar porcentagem
            const percentId = `#percent-${metodo.toLowerCase()}`;
            const percentElement = document.querySelector(percentId);
            if (percentElement) {
                const totalGeral = Object.values(vendasHoje).reduce((a, b) => a + b, 0);
                const percentual = (valor / totalGeral) * 100;
                percentElement.textContent = `${percentual.toFixed(2)}%`;
            }

            // Atualizar barra de progresso
            const barId = `#bar-${metodo.toLowerCase()}`;
            const barElement = document.querySelector(barId);
            if (barElement) {
                const totalGeral = Object.values(vendasHoje).reduce((a, b) => a + b, 0);
                const percentual = (valor / totalGeral) * 100;
                barElement.style.width = `${percentual}%`;
            }
        });

        // Atualizar gráfico de distribuição
        const totalGeral = Object.values(vendasHoje).reduce((a, b) => a + b, 0);
        if (totalGeral > 0 && distributionChart) {
            atualizarDistribuicao(data.vendas_diarias);
        }

    } catch (error) {
        //console.error('Erro ao atualizar dados:', error);
    }
}

// Função para configurar o gráfico de distribuição
function inicializarGraficoDistribuicao() {
    const options = {
        chart: {
            type: 'donut',
            height: '100%',
            toolbar: {
                show: false
            }
        },
        series: [],
        labels: ['Dinheiro', 'M-pesa', 'E-Mola', 'Outros'],
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                return total + '%';
                            }
                        }
                    }
                }
            }
        },
        dataLabels: { enabled: false },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        },
        colors: ['#10B981', '#6366F1', '#F59E0B', '#CBD5E1'],
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + '%';
                }
            }
        },
        responsive: [
            {
                breakpoint: 640,
                options: {
                    chart: {
                        height: '300px'
                    },
                    legend: {
                        fontSize: '12px'
                    }
                }
            }
        ]
    };

    distributionChart = new ApexCharts(document.querySelector('#distribuicao-pagamentos'), options);
    distributionChart.render();
}

// Função para atualizar o gráfico de distribuição
function atualizarDistribuicao(vendasDiarias) {
    if (!distributionChart) return;

    // Calcular porcentagens para cada método de pagamento
    const totalGeral = vendasDiarias.reduce((total, venda) => total + parseFloat(venda.total_vendas), 0);
    const series = vendasDiarias.map(venda => {
        const percentual = (parseFloat(venda.total_vendas) / totalGeral) * 100;
        return percentual;
    });

    // Atualizar o gráfico
    distributionChart.updateSeries(series);
}

// Função para inicializar a animação do banner de boas-vindas
function inicializarAnimacaoBanner() {
    const options = {
        chart: {
            type: 'area',
            height: 200,
            background: 'transparent',
            sparkline: {
                enabled: true
            },
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                    speed: 1000
                }
            }
        },
        colors: ['rgba(255, 255, 255, 0.8)'],
        series: [{
            name: 'Onda',
            data: Array.from({
                length: 20
            }, (_, i) => ({
                x: i,
                y: Math.sin(i / 3) * 20 + Math.random() * 5
            }))
        }],
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        tooltip: {
            enabled: false
        },
        grid: {
            show: false
        },
        xaxis: {
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                show: false
            }
        }
    };

    const welcomeChart = new ApexCharts(document.querySelector('#welcome-animation'), options);
    welcomeChart.render();

    // Função para atualizar a animação
    function atualizarAnimacao() {
        const newData = Array.from({
            length: 20
        }, (_, i) => ({
            x: i,
            y: Math.sin(i / 3 + Date.now() / 1000) * 20 + Math.random() * 5
        }));

        welcomeChart.updateSeries([{
            data: newData
        }]);
    }

    // Atualizar a animação a cada 100ms
    setInterval(atualizarAnimacao, 100);
}

// Função para configurar o gráfico semanal
function inicializarGraficoSemanal() {
    $.ajax({
        url: "{{ route('dashboard-operator.vendas-semanais') }}",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            const hoje = new Date();
            const primeiroDiaSemana = new Date(hoje);
            primeiroDiaSemana.setDate(hoje.getDate() - hoje.getDay() + 1);
            const ultimoDiaSemana = new Date(primeiroDiaSemana);
            ultimoDiaSemana.setDate(primeiroDiaSemana.getDate() + 6);

            const formatarData = (data) => {
                return data.toLocaleDateString('pt-BR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            };

            // Função para formatar números sem o sufixo MTn
            const formatarNumero = (valor) => {
                return new Intl.NumberFormat('pt-MZ', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(valor);
            };

            $('#semana-estatisticas').html(
                `${formatarData(primeiroDiaSemana)} à ${formatarData(ultimoDiaSemana)}`
            );

            const options = {
                chart: {
                    type: 'line',
                    height: 365,
                    toolbar: {
                        show: true
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        }
                    }
                },
                colors: ['#13c2c2'],
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        borderRadius: 0,
                        dataLabels: {
                            position: 'top'
                        },
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: formatarNumero,
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                legend: {
                    show: false
                },
                series: [{
                    name: 'Vendas Diárias',
                    data: response.valores || Array(7).fill(0)
                }],
                xaxis: {
                    categories: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    position: 'bottom',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: formatarNumero
                    }
                },
                tooltip: {
                    y: {
                        formatter: formatarNumero
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4
                }
            };

            if (weeklyChart) {
                weeklyChart.destroy();
            }
            weeklyChart = new ApexCharts(document.querySelector('#income-overview-chart'), options);
            weeklyChart.render();
        },
        error: function(xhr, status, error) {
            //console.error("Erro ao carregar dados semanais:", error);
        }
    });
}

// Função para verificar se um elemento existe
function elementoExiste(seletor) {
    return document.querySelector(seletor) !== null;
}

// Inicialização quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    //console.log('Iniciando dashboard...');

    // Inicializar apenas os gráficos que têm elementos HTML correspondentes
    const elementosGraficos = {
        'welcome-animation': inicializarAnimacaoBanner,
        'sparkline-dinheiro': () => inicializarSparklines(),
        'income-overview-chart': () => {
            inicializarGraficoSemanal();
        },
        'distribuicao-pagamentos': inicializarGraficoDistribuicao
    };

    // Inicializar apenas os gráficos que têm elementos presentes
    Object.entries(elementosGraficos).forEach(([id, inicializador]) => {
        if (elementoExiste(`#${id}`)) {
            inicializador();
        }
    });

    // Configurar atualizações automáticas apenas para elementos que existem
    setTimeout(async () => {
        if (typeof atualizarDados === 'function') {
            await atualizarDados();
            setInterval(atualizarDados, updateInterval);
        }
        
        if (elementoExiste('#income-overview-chart')) {
         
            setInterval(inicializarGraficoSemanal, updateInterval);
        }
    }, 1000);
});
</script>