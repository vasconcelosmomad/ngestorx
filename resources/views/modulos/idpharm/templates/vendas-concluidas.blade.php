<main class="pt-20 pb-20 px-4 max-w-screen-xl mx-auto">
<input type="hidden" id="token" value="{{ csrf_token() }}">
    <!-- Breadcrumb -->
    <div class="mb-4">
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
                                <a href="javascript: void(0)" class="text-gray-500 hover:text-blue-400 text-sm md:text-base">Vendas</a>
                            </li>
                            <li class="flex items-center">
                                <span class="mx-2 text-gray-400">/</span>
                                <a href="javascript: void(0)" class="text-gray-500 hover:text-blue-400 text-sm md:text-base">Vendas Concluidas</a>
                            </li>
                          
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@php if(isMobile()){
$component = 'components.vendas-concluida-mobile-devices';
}else{
$component = 'components.vendas-concluidas-desktop-devices';
}
@endphp
@include($component)

</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  var urlFaturaRecibo = "{{ route('print.fatura.recibo', ':id') }}";
var urlClientes = "{{ route('get.clientes') }}";
var urlVendasConcluidas = "{{ route('get.fr-emitidas') }}";
var urlCancelarFr = "{{ route('cancelar.fr', ':id') }}";  
let heightTable = 746;
const heightHeader = 212;
const rowHeight = 70;
let numRows = 15;

function updateTableHeight() {
    let screenHeight = window.innerHeight;
    heightTable = screenHeight - heightHeader;
    numRows = Math.floor(heightTable / rowHeight);
    
    // Se a tabela já foi inicializada, atualize o comprimento da página
    let table = $('#vendas-concluidas-tab1').DataTable();
    if (table) {
        table.page.len(numRows).draw();
    }
}

window.addEventListener("resize", updateTableHeight);

function aplicarEstilosTailwind() {
    $('.dt-paging button').attr('style',
        'background-color: white; border: 1px solid #ccc; padding: 0px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease; margin: 1px;'
    );

    $('.dt-input').attr('style',
        'border: 1px solid #ccc; padding: 5px 10px; border-radius: 5px;  transition: background-color 0.3s ease; margin-bottom: 10px;'
    );

    $('.dt-paging .dt-paging-button.current').attr('style',
        'background-color: #007bff; color: white;  border: 1px solid #ccc; padding: 0px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;'
    );
}

$(document).ready(function() {
    // Configuração global do alertify para todo o sistema
    alertify.defaults.glossary.title = "Confirmação";
    alertify.defaults.glossary.ok = "Confirmar";
    alertify.defaults.glossary.cancel = "Cancelar";
    
    // Configurações de comportamento
    alertify.defaults.transition = "zoom";
    alertify.defaults.movable = false;
    alertify.defaults.closable = true;
    
    // Configuração do notificador
    alertify.set("notifier", "position", "top-right");
    
    aplicarEstilosTailwind();
    initTable();
    initTableMobile();
});

// Adicionar evento para quando a página for recarregada
$(window).on('load', function() {
    aplicarEstilosTailwind();
});

// Garantir que os estilos sejam aplicados mesmo após atualizações AJAX
$(document).ajaxComplete(function() {
    aplicarEstilosTailwind();
});

function initTable(){
    updateTableHeight();
    $('#vendas-concluidas-tab1').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        dom: "bftrip",
        pageLength: numRows, // Use o número de linhas calculado

        select: true,
        fixedHeader: {
            header: true,
            headerOffset: heightHeader
        },
        paging: true,
        createdRow: function(row, data, dataIndex) {
            // Adiciona classes do Tailwind para criar o efeito striped
            if (dataIndex % 2 === 0) {
                $(row).addClass('bg-white');
            } else {
                $(row).addClass('bg-gray-50');
            }
        },
        headers: false,
        ajax: {
            url: urlVendasConcluidas,
            type: 'GET',
        },
        columns: [{
                data: "id",
                orderable: true,
                render: function(data, type, row) {
                    return '<a href="#" onclick="verVenda(this, ' + row.id +
                        ')"><span class="text-dark">VD: ' + data + '</span></a>';
                }
            },
            {
                data: "data_emissao",
                orderable: false,
                render: function(data, type, row) {
                    let dataFormatada = '';
                    if (row.data_emissao) {
                        const data = new Date(row.data_emissao);
                        const dia = data.getDate().toString().padStart(2, '0');
                        const mes = (data.getMonth() + 1).toString().padStart(2, '0');
                        const ano = data.getFullYear();
                        dataFormatada = `${dia}-${mes}-${ano}`;
                    } else {
                        dataFormatada = row.data_emissao;
                    }
                    
                    return dataFormatada;
                },
            },
            {
                data: "total",
                orderable: false,
                render: function(data, type, row) {
                    //Formata o valor para 2 casas decimais com vírgula como separador decimal
                    return Number(data).toFixed(2).replace('.', ',');
                },
            },

            {
                data: "status",
                orderable: false,
                render: function(data, type, row) {
                    if (data == "Concluída") {
                        return '<span class="inline-flex px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-md">Concluída</span>';
                    } else {
                        return '<span class="inline-flex px-2 py-1 text-xs font-medium text-white bg-red-500 rounded-md">Cancelada</span>';
                    }
                }
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
<div class="dropdown relative inline-block text-left">
    <button class="dropdown-button p-2 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-md w-10 h-10">
        <i data-lucide="menu" class="w-5 h-5 text-white" ></i>
    </button>
    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
        <div class="py-1">
            <a href="#"  onclick="reimprimirRecibo(this, ${row.id},'${row.status}')" class="text-sm text-gray-700 block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                <i data-lucide="printer" class="w-5 h-5"></i> Reimprimir Recibo
            </a>
            <div class="border-t border-gray-200 my-1"></div>
            <a href="#" onclick="cancelarFr(this, ${row.id})" class="text-sm text-gray-700 block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                <i data-lucide="x" class="w-5 h-5 text-red-500"></i> Cancelar Venda
            </a>
        </div>
    </div>
</div>
`;
                }
            },

        ],

        language: {
            lengthMenu: "Mostrar _MENU_ vendas",
            search: " ",
            searchPlaceholder: "Pesquisar Nº Venda",

            zeroRecords: "Nenhuma venda concluída encontrada",
            infoEmpty: "",
            infoFiltered: "",

        },
        info: false,
        lengthChange: false,
        drawCallback: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();

            // Reaplica a lógica do dropdown após a renderização do DataTables
            const dropdownButtons = document.querySelectorAll('.dropdown-button');
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');

            dropdownButtons.forEach((button, index) => {
                const menu = dropdownMenus[index];

                button.addEventListener("click", function(event) {
                    event.stopPropagation(); // Impede que o evento de clique se propague para o document

                    // Fecha todos os outros menus
                    dropdownMenus.forEach((otherMenu, otherIndex) => {
                        if (otherMenu !== menu) {
                            otherMenu.classList.add("hidden");
                        }
                    });

                    // Alterna a visibilidade do menu atual
                    menu.classList.toggle("hidden");
                });
            });

            // Fechar os dropdowns se o usuário clicar fora deles
            window.addEventListener("click", function(event) {
                dropdownMenus.forEach((menu) => {
                    if (!menu.previousElementSibling.contains(event.target) && !menu.contains(event.target)) {
                        menu.classList.add("hidden"); // Esconde o menu
                    }
                });
            });
        },
        initComplete: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        },

    });
    }

    function initTableMobile(){
    updateTableHeight();
    $('#vendas-concluidas-tab2').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        dom: "bftrip",
        pageLength: numRows, // Use o número de linhas calculado

        select: true,
        fixedHeader: {
            header: true,
            headerOffset: heightHeader
        },
        paging: true,
        createdRow: function(row, data, dataIndex) {
            // Adiciona classes do Tailwind para criar o efeito striped
            if (dataIndex % 2 === 0) {
                $(row).addClass('bg-white');
            } else {
                $(row).addClass('bg-gray-50');
            }
        },
        headers: false,
        ajax: {
            url: urlVendasConcluidas,
            type: 'GET',
        },
        columns: [ {
                data: null,
                render: function(data, type, row) {
                    let dataFormatada = '';
                    if (row.data_emissao) {
                        const data = new Date(row.data_emissao);
                        const dia = data.getDate().toString().padStart(2, '0');
                        const mes = (data.getMonth() + 1).toString().padStart(2, '0');
                        const ano = data.getFullYear();
                        dataFormatada = `${dia}-${mes}-${ano}`;
                    } else {
                        dataFormatada = row.data_emissao;
                    }
                    
                    return `
                        <div class="flex flex-col text-left justify-start">
                            <p class="text-base text-gray-800 py-0 mb-0">VD: ${row.id}</p>
                            <small class="text-xs text-gray-500 mb-0">
                                <span class="text-gray-800 font-medium">Data:</span> ${dataFormatada}
                            </small>
                          
                        </div>`;
                },
            },
           
            {
                data: "total",
                orderable: false,
                render: function(data, type, row) {
                    //Formata o valor para 2 casas decimais com vírgula como separador decimal
                    return Number(data).toFixed(2).replace('.', ',');
                },
            },

            {
                data: "status",
                orderable: false,
                render: function(data, type, row) {
                    if (data == "Concluída") {
                        return '<span class="inline-flex px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-md">Concluída</span>';
                    } else {
                        return '<span class="inline-flex px-2 py-1 text-xs font-medium text-white bg-red-500 rounded-md">Cancelada</span>';
                    }
                }
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
            <div class="dropdown relative inline-block text-left">
                <button class="dropdown-button p-2 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-md w-10 h-10">
                    <i data-lucide="menu" class="w-5 h-5 text-white" ></i>
                </button>
                <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1">
                        <a href="#" onclick="reimprimirRecibo(this, ${row.id},'${row.status}')" class="text-sm text-gray-700 block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                            <i data-lucide="printer" class="w-5 h-5"></i> Reimprimir Recibo
                        </a>
                        <div class="border-t border-gray-200 my-1"></div>
                        <a href="#" onclick="cancelarFr(this, ${row.id})" class="text-sm text-gray-700 block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                            <i data-lucide="x" class="w-5 h-5 text-red-500"></i> Cancelar Venda
                        </a>
                    </div>
                </div>
            </div>
            `;
                }
            },

        ],

        language: {
            lengthMenu: "Mostrar _MENU_ vendas",
            search: " ",
            searchPlaceholder: "Pesquisar Nº Venda",

            zeroRecords: "Nenhuma venda concluída encontrada",
            infoEmpty: "",
            infoFiltered: "",

        },
        info: false,
        lengthChange: false,
        drawCallback: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();

            // Reaplica a lógica do dropdown após a renderização do DataTables
            const dropdownButtons = document.querySelectorAll('.dropdown-button');
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');

            dropdownButtons.forEach((button, index) => {
                const menu = dropdownMenus[index];

                button.addEventListener("click", function(event) {
                    event.stopPropagation(); // Impede que o evento de clique se propague para o document

                    // Fecha todos os outros menus
                    dropdownMenus.forEach((otherMenu, otherIndex) => {
                        if (otherMenu !== menu) {
                            otherMenu.classList.add("hidden");
                        }
                    });

                    // Alterna a visibilidade do menu atual
                    menu.classList.toggle("hidden");
                });
            });

            // Fechar os dropdowns se o usuário clicar fora deles
            window.addEventListener("click", function(event) {
                dropdownMenus.forEach((menu) => {
                    if (!menu.previousElementSibling.contains(event.target) && !menu.contains(event.target)) {
                        menu.classList.add("hidden"); // Esconde o menu
                    }
                });
            });
        },
        initComplete: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        },

    });
    }

//[FUNÇÃO] PARA CANCELAR Fatura Recibo
function cancelarFr(button, id) {
    var $button = $(button);
    var faturaId = $button.data("id") || id;
    
    alertify.confirm()
        .setting({
            'title': 'Cancelar Fatura/Recibo',
            'message': `Tem certeza que deseja cancelar a Fatura Recibo ${faturaId}?`,
            'labels': {
                ok: 'Confirmar',
                cancel: 'Cancelar'
            },
            'onok': function() {
                // Usando Axios ao invés de $.ajax
                axios.post(urlCancelarFr.replace(":id", faturaId), {
                    id: faturaId,
                    _token: document.getElementById('token').value
                })
                .then(function(response) {
                    const data = response.data;
                    if (data.success) {
                        // Estilizando a notificação de sucesso
                        alertify.notify(
                            `<div class="flex items-center">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                                <span>A Fatura Recibo ${faturaId} foi cancelada com sucesso!</span>
                            </div>`,
                            "success",
                            5,
                            function() {
                                // Callback após fechar a notificação
                                lucide.createIcons();
                            }
                        );
                        
                        // Recarregar os dados da tabela
                        $('#vendas-concluidas-tab1').DataTable().ajax.reload(null, false);
                        $('#vendas-concluidas-tab2').DataTable().ajax.reload(null, false);
                    } else {
                        alertify.notify(
                            `<div class="flex items-center">
                                <i data-lucide="alert-circle" class="w-5 h-5 mr-2 text-red-500"></i>
                                <span>${data.message || 'Erro ao cancelar a Fatura Recibo'}</span>
                            </div>`,
                            "error",
                            5,
                            function() {
                                lucide.createIcons();
                            }
                        );
                        console.log(data);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    alertify.notify(
                        `<div class="flex items-center">
                            <i data-lucide="x-circle" class="w-5 h-5 mr-2 text-red-500"></i>
                            <span>Ocorreu um erro ao cancelar a Fatura Recibo.</span>
                        </div>`,
                        "error",
                        5,
                        function() {
                            lucide.createIcons();
                        }
                    );
                })
                .finally(function() {
                    // Inicializar os ícones do Lucide após a notificação
                    setTimeout(() => {
                        lucide.createIcons();
                    }, 100);
                });
            }
        }).show();
        
    // Inicializar os ícones do Lucide após o diálogo ser exibido
    setTimeout(() => {
        lucide.createIcons();
    }, 100);
}

//[FUNÇÃO] REIMPRIMIR RECIBO
function reimprimirRecibo(button, id, status) {
    
    if (status == "Cancelada") {
        alertify.notify(
            `<div class="flex items-center">
                <i data-lucide="x-circle" class="w-5 h-5 mr-2 text-red-500"></i>
                <span>Impossível reimprimir o Recibo, pois a Fatura Recibo ${id} foi cancelada!</span>
            </div>`,
            "error",
            5,
            function() {
                lucide.createIcons();
            }
        );
        return;
    }
    var $button = $(button);
    var reciboId = $button.data("id") || id;
    var url = urlFaturaRecibo;
    url = url.replace(":id", reciboId);
    let printWindow = window.open(url, "_blank");
    printWindow.onload = function () {
        printWindow.print();
        setTimeout(() => {
            printWindow.close();
        }, 3000);
    };
}
</script>
