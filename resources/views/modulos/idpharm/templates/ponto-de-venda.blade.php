@php if(isMobile()){
$component = 'components.pdv-mobile-devices';
}else{
$component = 'components.pdv-desktop-devices';
}
@endphp
@include($component)
<audio hidden id="audio-beep" src="{{ url('assets/audio/beep.wav') }}"></audio>
<!-- Scripts -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ url('assets/js/pdv.js') }}"></script>



<script>
const urlListaProdutos = "{{ route('api.produtos.pdv')}}";

var urlItensVenda = "{{ route('itens.venda') }}";
var urlRemoverItemVenda = "{{ route('remover.item.venda') }}";
var urlAddProduto = "{{ route('add.produto.pdv') }}";
var urlMetodosPagamento = "{{ route('metodos.pagamento') }}";
var urlVendaDinheiro = "{{ route('finalizar.vd') }}";
var urlFaturaRecibo = "{{ route('print.fatura.recibo', ':id') }}";
var urlClientes = "{{ route('get.clientes') }}";
var urlVendasConcluidas = "{{ route('get.fr-emitidas') }}";
var urlCancelarFr = "{{ route('cancelar.fr', ':id') }}";
const tabLinks = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');
lucide.createIcons();
tabLinks.forEach(link => {
    link.addEventListener('click', function() {
        tabContents.forEach(content => content.classList.add('hidden'));
        tabLinks.forEach(btn => btn.classList.remove('text-blue-600', 'border-blue-600'));
        listarProdutosDesktopDevices();
        aplicarEstilosTailwind();
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId).classList.remove('hidden');
        this.classList.add('text-blue-600', 'border-blue-600');
    });
});

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

let heightTable = 746;
const heightHeader = 212;
const rowHeight = 70;
let numRows = 10;

function updateTableHeight() {
    let screenHeight = window.innerHeight;
    heightTable = screenHeight - heightHeader;
    numRows = Math.floor(heightTable / rowHeight);
}

window.addEventListener("resize", updateTableHeight);



$(document).ready(function() {

    listarProdutosDesktopDevices();
    listarProdutosMobileDevices();
    aplicarEstilosTailwind();
});



function listarProdutosDesktopDevices() {
    updateTableHeight();

    var table = $('#get-produtos').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        dom: "bftrip",


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

        lengthMenu: [
            [numRows, 25, 50, -1],
            [numRows, 25, 50, "Todos"]
        ],
        ajax: {
            url: urlListaProdutos,
            type: 'GET',
            data: function(d) {
                d.draw = parseInt(d.draw);
                return d;
            }
        },
        columns: [{
                data: "nome"
            },
            {
                data: "lote"
            },
            {
                data: "data_compra",
                render: function(data) {
                    var date = new Date(data);
                    date.setHours(date.getHours() + 2);
                    return date.toLocaleString('pt-PT', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        timeZone: 'Africa/Maputo'
                    }).split(',')[0];
                }
            },
            {
                data: "estoque_disponivel"
            },
            {
                data: "preco_venda",
                render: function(data) {
                    return Number(data).toFixed(2).replace('.', ',');
                }
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                            <div class="flex justify-center">
                                <input type="text" name="qtd" value="1" min="1"
                                    onkeyup="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="text-lg border border-gray-300 rounded px-2 py-2 w-16 text-center" />
                            </div>`;
                }
            },

            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return '<button class="bg-blue-500 text-white px-2 py-2 rounded hover:bg-blue-600" id="btn-add-produto" onclick="addProduto(this, ' +
                        row.id_compra +
                        ')" style=" cursor: pointer;"><i data-lucide="plus-circle" class="w-5 h-5 text-white"></i></button>';
                }
            }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ produtos",
            search: " ",
            searchPlaceholder: "Pesquisar produto",

            zeroRecords: "Nenhum registro encontrado",
            infoEmpty: "",
            infoFiltered: "",

        },
        info: false,
        lengthChange: false,
        drawCallback: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        },
        initComplete: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        },

    });


}

function listarProdutosMobileDevices() {
    var table = $('#get-produtos-mobile').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        dom: "ft", // Remove paginação, info, lengthMenu, etc. Mostra apenas 'f' (search) e 't' (tabela)
        select: true,
        responsive: true,
        pageLength: 3, // Mostrar apenas 4 registros por página
        fixedHeader: {
            header: true,
            headerOffset: heightHeader
        },
        paging: true,
        lengthChange: false,
        info:true,
        createdRow: function(row, data, dataIndex) {
            if (dataIndex % 2 === 0) {
                $(row).addClass('bg-white');
            } else {
                $(row).addClass('bg-gray-50');
            }
        },
        ajax: {
            url: urlListaProdutos,
            type: 'GET',
            data: function(d) {
                d.draw = parseInt(d.draw);
                return d;
            }
        },
        columns: [
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <div class="flex flex-col text-left justify-start">
                            <p class="text-base text-gray-800 py-0 mb-0">${row.nome}</p>
                            <small class="text-xs text-gray-500 mb-0">
                                <span class="text-gray-800 font-medium">Lote:</span> ${row.lote} 
                                <span class="text-gray-800 font-medium">Stock:</span> ${row.estoque_disponivel}
                            </small>
                            <small class="text-xs text-gray-500 mb-0">
                                <span class="text-gray-800 font-medium">Data:</span> ${row.data_compra}
                            </small>
                        </div>`;
                }
            },
            {
                data: "preco_venda",
                render: function(data) {
                    return Number(data).toFixed(2).replace('.', ',');
                }
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <div class="flex justify-center">
                            <input type="text" name="qtd" value="1" min="1"
                                onkeyup="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="text-lg border border-gray-300 rounded px-1 py-0.5 w-16 text-center" />
                        </div>`;
                }
            },
            {
                data: null,
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `<button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600" id="btn-add-produto" onclick="addProduto(this, ${row.id_compra})" style=" cursor: pointer;">
                                <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
                            </button>`;
                }
            }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ produtos",
            search: " ",
            searchPlaceholder: "Pesquisar produto",
            zeroRecords: "Nenhum registro encontrado",
            infoEmpty: "",
            infoFiltered: "",
        },
        drawCallback: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        },
        initComplete: function() {
            aplicarEstilosTailwind();
            lucide.createIcons();
        }
    });
}




//Carregar caixas
$(document).ready(function() {
    verificarCaixa();
});

</script>

<style>
#get-produtos tbody tr:hover {
    background-color: rgb(239 246 255);
    /* Cor equivalente ao bg-blue-50 */
    transition: background-color 150ms ease-in-out;
}

</style>