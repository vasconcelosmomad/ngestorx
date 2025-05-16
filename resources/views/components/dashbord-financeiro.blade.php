<main class="pt-24 pb-28 px-4 sm:px-6 lg:px-8 w-full">
@php
    setlocale(LC_TIME, 'pt_PT'); // Definindo o local para português
    $data = strftime('%d-%B-%Y'); // Exibe o nome do mês por extenso
    $dataOntem = strftime('%d-%B-%Y', strtotime('-1 day')); // Exibe a data de ontem com o nome do mês
    @endphp
    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="w-full lg:px-8 mb-6">
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
    <div class="w-full lg:px-8 mb-6">
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
                     
                        <div class="w-full max-w-lg mx-auto">
                            <!-- Elemento para a animação -->
                            <div id="welcome-animation" class="h-[200px] flex flex-col items-center justify-center p-4">
                                <div class="text-center mb-4">
                                    <h3 class="text-white text-lg font-semibold mb-2">Movimento Financeiro</h3>
                                    <p class="text-white/80 text-sm">Atualizado em tempo real</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4 w-full">
                                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                                        <p class="text-white/70 text-sm">Receitas Hoje</p>
                                        <div id="receitas-hoje" class="text-2xl font-bold text-green-300">0</div>
                                        <p class="text-xs text-white/60 mt-1">MT</p>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                                        <p class="text-white/70 text-sm">Despesas Hoje</p>
                                        <div id="despesas-hoje" class="text-2xl font-bold text-red-300">0</div>
                                        <p class="text-xs text-white/60 mt-1">MT</p>
                                    </div>
                                </div>
                                <div class="mt-4 w-full bg-white/20 h-2 rounded-full overflow-hidden">
                                    <div id="saldo-bar" class="h-full bg-gradient-to-r from-green-400 to-blue-400 transition-all duration-1000" style="width: 0%"></div>
                                </div>
                                <p class="text-xs text-white/70 mt-2">Saldo do Dia: <span id="saldo-dia" class="font-semibold">0 MT</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="w-full lg:px-8 mb-6">
    <!-- Cartões de Vendas por Método de Pagamento -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
      <!-- Dinheiro -->
      <div class="border bg-white shadow rounded-xl p-5 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:border-emerald-100">
        <div class="flex items-center justify-between mb-2">
          <i data-lucide="dollar-sign" class="w-6 h-6 text-emerald-600 transition-transform duration-300 group-hover:scale-110"></i>
          <span class="text-xs text-gray-500">{{ $data }}</span>
        </div>
        <p class="text-sm text-gray-500">Vendas em Dinheiro</p>
        <div class="flex items-baseline justify-between mt-2">
          <p class="text-xl font-semibold text-emerald-700 group-hover:text-emerald-800 transition-colors duration-300">1.200 MT</p>
          <span class="text-xs text-emerald-600 bg-emerald-100 px-2 py-1 rounded-full group-hover:bg-emerald-200 transition-colors duration-300">+12%</span>
        </div>
      </div>

      <!-- M-Pesa -->
      <div class="border bg-white shadow rounded-xl p-5 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:border-yellow-100">
        <div class="flex items-center justify-between mb-2">
          <i data-lucide="smartphone" class="w-6 h-6 text-yellow-600 transition-transform duration-300 group-hover:scale-110"></i>
          <span class="text-xs text-gray-500">{{ $data }}</span>
        </div>
        <p class="text-sm text-gray-500">Vendas M-Pesa</p>
        <div class="flex items-baseline justify-between mt-2">
          <p class="text-xl font-semibold text-yellow-700 group-hover:text-yellow-800 transition-colors duration-300">800 MT</p>
          <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full group-hover:bg-yellow-200 transition-colors duration-300">+5%</span>
        </div>
      </div>

      <!-- Emola -->
      <div class="border bg-white shadow rounded-xl p-5 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:border-purple-100">
        <div class="flex items-center justify-between mb-2">
          <i data-lucide="activity" class="w-6 h-6 text-purple-600 transition-transform duration-300 group-hover:scale-110"></i>
          <span class="text-xs text-gray-500">{{ $data }}</span>
        </div>
        <p class="text-sm text-gray-500">Vendas Emola</p>
        <div class="flex items-baseline justify-between mt-2">
          <p class="text-xl font-semibold text-purple-700 group-hover:text-purple-800 transition-colors duration-300">600 MT</p>
          <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded-full group-hover:bg-purple-200 transition-colors duration-300">+8%</span>
        </div>
      </div>

      <!-- Outros -->
      <div class="border bg-white shadow rounded-xl p-5 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:border-gray-100">
        <div class="flex items-center justify-between mb-2">
          <i data-lucide="layers" class="w-6 h-6 text-gray-500 transition-transform duration-300 group-hover:scale-110"></i>
          <span class="text-xs text-gray-500">{{ $data }}</span>
        </div>
        <p class="text-sm text-gray-500">Outros Pagamentos</p>
        <div class="flex items-baseline justify-between mt-2">
          <p class="text-xl font-semibold text-gray-700 group-hover:text-gray-800 transition-colors duration-300">400 MT</p>
          <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full group-hover:bg-gray-200 transition-colors duration-300">+2%</span>
        </div>
      </div>
    </div>

<!-- Gráficos em Linha/Coluna -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Gráfico de Barras - Vendas Semanais -->
    <div class="bg-white rounded-lg shadow p-4 md:p-6 overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Vendas Semanais</h3>
        <div id="vendasSemanaisChart" style="min-height: 300px;"></div>
    </div>

    <!-- Gráfico de Rosca - Métodos de Pagamento -->
    <div class="bg-white rounded-lg shadow p-4 md:p-6 overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribuição por Método de Pagamento</h3>
        <div id="metodosPagamentoChart" style="min-height: 300px;"></div>
    </div>
</div>

<!-- Gráfico de Barras para Desempenho Trimestral -->
<div class="border bg-white p-4 shadow rounded-xl mb-6">
    <h5 class="text-lg text-gray-900 mb-4">Desempenho Trimestral</h5>
    <div id="grafico-barras"></div>
</div>

<!-- Gráficos -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <!-- Gráfico de Linhas (Receitas vs Despesas) -->
      <div class="border bg-white p-6 shadow rounded-xl">
        <h5 class="text-lg flex items-center gap-2 mb-4"><i data-lucide="line-chart" class="text-blue-500 w-6 h-6"></i> Comparativo de Receitas e Despesas</h5>
        <div id="grafico-linhas" class="h-[300px] w-full"></div>
      </div>

      <!-- Gráfico de Pizza (Distribuição das Despesas) -->
      <div class="border bg-white p-4 shadow rounded-xl">
        <h5 class="text-lg flex items-center gap-2 mb-4"><i data-lucide="pie-chart" class="text-blue-500 w-6 h-6"></i> Distribuição das Despesas</h5>
        <div id="grafico-pizza"></div>
      </div>
    </div>
</div>
</main>
<!-- Start Footer com botão de menu -->
@include('components.footer')
<!-- End Footer -->
  <script>
    lucide.createIcons();

    // Gráfico de Barras - Desempenho Trimestral
    const chartBarras = new ApexCharts(document.querySelector("#grafico-barras"), {
      chart: {
        type: 'bar',
        height: 350,
        toolbar: { show: false },
        stacked: false
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '60%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      series: [{
        name: 'Receita',
        data: [5000, 6000, 5500, 7000, 6800, 7200]
      }, {
        name: 'Despesa',
        data: [3200, 4000, 3000, 3900, 3500, 4100]
      }, {
        name: 'Lucro',
        data: [1800, 2000, 2500, 3100, 3300, 3100]
      }],
      xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun']
      },
      yaxis: {
        title: {
          text: 'Valor (MT)'
        }
      },
      fill: {
        opacity: 0.9
      },
      colors: ['#16a34a', '#dc2626', '#2563eb'],
      legend: {
        position: 'top'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "MT " + val.toLocaleString('pt-PT')
          }
        }
      }
    });
    chartBarras.render();

    const chartLinhas = new ApexCharts(document.querySelector("#grafico-linhas"), {
      chart: {
        type: 'line',
        height: 300,
        toolbar: { show: false }
      },
      series: [{
        name: 'Receita',
        data: [5000, 6000, 5500, 7000, 6800, 7200]
      }, {
        name: 'Despesa',
        data: [3200, 4000, 3000, 3900, 3500, 4100]
      }],
      xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun']
      },
      colors: ['#16a34a', '#dc2626']
    });
    chartLinhas.render();

    const chartPizza = new ApexCharts(document.querySelector("#grafico-pizza"), {
      chart: {
        type: 'donut',
        height: 300
      },
      labels: ['Salários', 'Aluguel', 'Contas'],
      series: [50, 30, 20],
      colors: ['#0ea5e9', '#facc15', '#f97316']
    });
    chartPizza.render();
  </script>


<!-- CountUp.js para animação de números -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.3.2/countUp.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variáveis para armazenar os valores atuais
    let receitasAtuais = Math.floor(Math.random() * 5000) + 1000; // Valor aleatório entre 1000 e 6000
    let despesasAtuais = Math.floor(Math.random() * 3000) + 500;  // Valor aleatório entre 500 e 3500
    
    // Inicializa as animações
    const options = {
        duration: 1.5,
        separator: '.',
        decimal: ',',
        prefix: '',
        suffix: ''
    };

    // Inicializa os contadores
    const receitasCounter = new CountUp('receitas-hoje', 0, 0, 2, 1, options);
    const despesasCounter = new CountUp('despesas-hoje', 0, 0, 2, 1, options);
    
    // Função para atualizar os valores
    function atualizarValores(receitas, despesas) {
        const saldo = receitas - despesas;
        const total = receitas + despesas;
        const percentual = total > 0 ? (receitas / total) * 100 : 50;
        
        // Atualiza os contadores
        receitasCounter.update(receitas);
        despesasCounter.update(despesas);
        
        // Atualiza a barra de saldo
        const saldoBar = document.getElementById('saldo-bar');
        if (saldoBar) {
            saldoBar.style.transition = 'width 1.5s ease-in-out';
            saldoBar.style.width = `${Math.min(100, Math.max(0, percentual))}%`;
        }
        
        // Atualiza o saldo do dia
        const saldoDia = document.getElementById('saldo-dia');
        if (saldoDia) {
            saldoDia.textContent = `${saldo.toLocaleString('pt-PT')} MT`;
            saldoDia.className = saldo >= 0 ? 'font-semibold text-green-300' : 'font-semibold text-red-300';
        }
        
        // Atualiza o horário da última atualização
        const agora = new Date();
        const horaFormatada = agora.toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit' });
        const atualizadoEm = document.querySelector('.atualizado-em');
        if (atualizadoEm) {
            atualizadoEm.textContent = `Atualizado às ${horaFormatada}`;
            atualizadoEm.style.opacity = '0';
            setTimeout(() => { atualizadoEm.style.opacity = '1'; }, 50);
        }
    }
    
    // Inicializa com os primeiros valores
    atualizarValores(receitasAtuais, despesasAtuais);
    
    // Simula atualização em tempo real a cada 10 segundos
    setInterval(() => {
        // Gera variações aleatórias
        const variacaoReceita = Math.floor(Math.random() * 200) - 50; // Variação entre -50 e 150
        const variacaoDespesa = Math.floor(Math.random() * 100) - 25; // Variação entre -25 e 75
        
        // Atualiza os valores atuais com as variações
        receitasAtuais = Math.max(100, receitasAtuais + variacaoReceita);
        despesasAtuais = Math.max(50, despesasAtuais + variacaoDespesa);
        
        // Atualiza a interface
        atualizarValores(receitasAtuais, despesasAtuais);
    }, 10000); // Atualiza a cada 10 segundos
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verifica se o ApexCharts está disponível
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts não foi carregado corretamente');
        return;
    }

    // Dados de exemplo
    const dadosSemanais = {
        categories: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        series: [{
            name: 'Vendas',
            data: [1200, 1900, 1500, 2300, 2700, 3200, 2900]
        }]
    };

    const metodosPagamento = {
        series: [35, 40, 15, 10],
        labels: ['MB Way', 'M-Pesa', 'Cartão', 'Dinheiro']
    };

    // Opções do gráfico de barras
    const vendasSemanaisOptions = {
        series: dadosSemanais.series,
        chart: {
            type: 'bar',
            height: '100%',
            fontFamily: 'Inter, sans-serif',
            toolbar: { show: false },
            animations: { enabled: true }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '45%'
            }
        },
        dataLabels: { enabled: false },
        xaxis: {
            categories: dadosSemanais.categories,
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            title: { text: 'Valor (MT)' },
            labels: {
                formatter: function(value) {
                    return value.toLocaleString('pt-PT');
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toLocaleString('pt-PT', { minimumFractionDigits: 2 }) + ' MT';
                }
            }
        },
        colors: ['#3B82F6']
    };


    // Opções do gráfico de rosca
    const metodosPagamentoOptions = {
        series: metodosPagamento.series,
        labels: metodosPagamento.labels,
        chart: {
            type: 'donut',
            height: '100%',
            fontFamily: 'Inter, sans-serif',
            toolbar: { show: false },
            animations: { enabled: true }
        },
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
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + '%';
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
        colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + '%';
                }
            }
        }
    };

    // Inicializar gráficos
    function initCharts() {
        // Gráfico de barras
        if (document.getElementById('vendasSemanaisChart')) {
            const vendasChart = new ApexCharts(
                document.querySelector("#vendasSemanaisChart"),
                vendasSemanaisOptions
            );
            vendasChart.render();
        }

        // Gráfico de rosca
        if (document.getElementById('metodosPagamentoChart')) {
            const metodosChart = new ApexCharts(
                document.querySelector("#metodosPagamentoChart"),
                metodosPagamentoOptions
            );
            metodosChart.render();
        }
    }

    // Inicializar quando o DOM estiver pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCharts);
    } else {
        // Se o DOM já estiver carregado, inicializa imediatamente
        setTimeout(initCharts, 100);
    }

    // Atualizar ao redimensionar
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.Apex && window.Apex.charts) {
                window.Apex.charts.exec().update();
            }
        }, 300);
    });
});
</script>
