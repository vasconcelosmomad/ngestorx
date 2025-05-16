//[EVENTO] INICIALIZAR CHOICES
document.addEventListener("DOMContentLoaded", function () {
    initializeChoices();
});

//[FUNÇÃO] INICIALIZAR CHOICES
function initializeChoices() {
    $(".menu-select").each(function () {
        if ($(this).data("choicesInstance")) {
            $(this).data("choicesInstance").destroy();
        }

        let instance = new Choices(this, {
            searchEnabled: false,
            removeItemButton: false,
        });

        $(this).data("choicesInstance", instance);
        this.style.width = "300px";
        this.style.height = "50px";
    });

    console.log("Choices.js inicializado");
}

//[FUNÇÃO] BUSCA OS MÉTODOS DE PAGAMENTO
$(document).ready(function () {
    getMetodosPagamento();
});
function getMetodosPagamento() {
    $.ajax({
        url: urlMetodosPagamento,
        method: "GET",
        success: function (response) {
            if (response.success) {
                var options =
                    '<option value="" selected disabled>Selecione</option>';
                $.each(
                    response.metodosPagamento,
                    function (index, metodoPagamento) {
                        options +=
                            '<option value="' +
                            metodoPagamento.id +
                            '">' +
                            metodoPagamento.nome +
                            "</option>";
                    }
                );

                $("#metodo-pagamento").html(options);

                // Reaplica o Choices.js após o AJAX
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao buscar métodos de pagamento:", error);
        },
    });
}

//[FUNÇÃO] CALCULAR TROCO
function calcularTroco(input, totalVendaId, trocoId) {
    var element = $(input);
    var valorRecebido = parseFloat(element.val().replace(",", "."));
    var totalVenda = $(totalVendaId);
    var totalVenda = parseFloat(totalVenda.val().replace(",", "."));

    if (
        isNaN(valorRecebido) ||
        isNaN(totalVenda) ||
        totalVenda === 0 ||
        valorRecebido < totalVenda
    ) {
        $(trocoId).val("0,00");

        return;
    }

    var troco = valorRecebido - totalVenda;
    //alert(troco);
    $(trocoId).val(troco.toFixed(2).replace(".", ","));
}

//[FUNÇÃO] CALCULAR PARCELAS
function calcularParcelas(dataInicial, numeroParcelas) {
    let datasPagamentos = [];
    let data = new Date(dataInicial);

    for (let i = 0; i < numeroParcelas; i++) {
        data.setMonth(data.getMonth() + 1);

        if (data.getDay() === 6) {
            data.setDate(data.getDate() + 2);
        } else if (data.getDay() === 0) {
            data.setDate(data.getDate() + 1);
        }

        datasPagamentos.push(formatarData(data));
    }

    return datasPagamentos;
}

//[FUNÇÃO] FORMATAR DATA
function formatarData(data) {
    let dia = String(data.getDate()).padStart(2, "0");
    let mes = String(data.getMonth() + 1).padStart(2, "0");
    let ano = data.getFullYear();
    return `${dia}/${mes}/${ano}`;
}

//Obter data atual
function obterDataAtual() {
    let data = new Date();
    let dia = String(data.getDate()).padStart(2, "0");
    let mes = String(data.getMonth() + 1).padStart(2, "0");
    let ano = data.getFullYear();
    return `${ano}-${mes}-${dia}`;
}

//Gerar parcelas
function gerarParcelas() {
    let numeroParcelas = parseInt($("#numero_parcelas").val());
    let dataInicial = obterDataAtual();
    let datas = calcularParcelas(dataInicial, numeroParcelas);
    let total = parseFloat($("#total-venda-hidden").val());
    if (
        numeroParcelas === null ||
        numeroParcelas === undefined ||
        numeroParcelas === 0
    ) {
        return;
    }
    if (total === null || total === undefined || total === 0) {
        return;
    }

    let totalParcelas = (total / numeroParcelas).toFixed(2).replace(".", ",");
    let container = $("#parcelas-container");
    container.html(""); // Limpa o conteúdo anterior

    // Criando a tabela com Bootstrap
    let tabela = $("<table>", {
        class: "table table-striped table-hover table-sm",
    });

    // Cabeçalho da tabela
    let thead = $("<thead>", {
        class: "table-dark",
    });
    let trCabeçalho = $("<tr>");
    trCabeçalho.append("<th>#</th>"); // Coluna para número da parcela
    trCabeçalho.append("<th>Data vencimento</th>"); // Coluna para data
    trCabeçalho.append("<th>Valor</th>"); // Coluna para valor
    thead.append(trCabeçalho);
    tabela.append(thead);

    // Corpo da tabela
    let tbody = $("<tbody>");

    datas.forEach((data, index) => {
        let tr = $("<tr>", {
            class: "text-center",
        });

        // Coluna número da parcela
        let tdNumero = $("<td>", {
            text: index + 1 + "ª",
        });

        // Coluna data da parcela
        let tdData = $("<td>", {
            text: data,
        });

        // Coluna valor da parcela
        let tdValor = $("<td>", {
            text: totalParcelas,
            class: "font-weight-bold",
        });

        tr.append(tdNumero);
        tr.append(tdData);
        tr.append(tdValor);

        tbody.append(tr);
    });

    tabela.append(tbody);
    container.append(tabela); // Adiciona a tabela ao container
}
$(document).ready(function () {
    gerarParcelas();
});

$(document).ready(function () {
    getItensVenda();
});

//[FUNÇÃO] CARREGAR ITENS DE VENDA
async function getItensVenda() {
    try {
        const response = await axios.get(urlItensVenda, {
            params: {
                _token: token,
            },
        });

        console.log(response.data);

        let li = "";
        let total = 0;
        let itens = 0;

        response.data.itensVenda.forEach((item) => {
            li += `
        <li class="flex justify-between items-center p-2  border-b transition-colors even:bg-gray-50 hover:bg-gray-100 rounded">
            <div class="flex-1">
                <h5 class="text-sm font-semibold">${item.nome_produto}</h5>
                <small class="text-xs text-gray-500">
                    ${item.quantidade} unidade(s) x ${item.pu} = ${item.total} mt
                </small>
            </div>
            <i data-lucide="list-x" class="w-5 h-5 text-red-500 hover:text-red-700 transition" style="cursor: pointer;"
            onclick="removerItem(this, ${item.id})"></i>
        </li>
    `;
            total += parseFloat(item.total);
            itens++;
        });

        document.getElementById("itens-venda").innerHTML = li;
        document.getElementById("total-venda").textContent = total.toFixed(2).replace(".", ",");
        document.getElementById("total-venda-hidden").value = total;
        document.getElementById("qtd-itens-venda").textContent = itens;
        
        // Recriar os ícones após adicionar novo conteúdo
        lucide.createIcons();
    } catch (error) {
        console.error("Erro:", error);
        alertify.error("Não foi possível carregar os itens de venda. Tente novamente.");
    }

}


//Função para remover item da venda
async function removerItem(button, id) {
 
    try {
        $(button).prop("disabled", true);

        await axios.post(urlRemoverItemVenda, {
            id: id,
            _token: token
        });

        getItensVenda();
        $("#get-produtos").DataTable().ajax.reload(null, false);
        $("#get-produtos-mobile").DataTable().ajax.reload(null, false);
        alertify.set("notifier", "position", "top-right");
        alertify.notify("Item removido da lista de venda, adicione novamente ao Stock", "success", 2);

    } catch (error) {
        alertify.notify("Erro ao remover item, verifique se o produto está em stock", "error", 2);
        console.error(error);
    } finally {
        $(button).prop("disabled", false);
    }
}


//[FUNÇÃO] ADICIONAR PRODUTO A LISTA DE VENDA
async function addProduto(button, id) {
    const audio = document.getElementById("audio-beep");
    const row = button.closest("tr");
    const inputQtd = row.querySelector('input[name="qtd"]');
    const qtd = parseInt(inputQtd.value, 10);

    if (isNaN(qtd) || qtd <= 0) {
        alertify.set("notifier", "position", "top-right");
        alertify.notify("Por favor, insira uma quantidade válida.", "error", 2);
        return;
    }

    button.disabled = true;

    try {
        const response = await axios.post(urlAddProduto, {
            id_compra: id,
            quantidade: qtd,
            _token: token,
        });

        console.log(response.data);

        if (response.data.success) {
            alertify.set("notifier", "position", "top-right");
            alertify.notify(response.data.message, "success", 3);

            getItensVenda();
            audio.play();
            audio.currentTime = 0;

            // Atualiza DataTable
            $("#get-produtos").DataTable().ajax.reload(null, true);
            $("#get-produtos").DataTable().search("").draw();
            $("#get-produtos-mobile").DataTable().ajax.reload(null, true);
            $("#get-produtos-mobile").DataTable().search("").draw();

        } else {
            alertify.set("notifier", "position", "top-right");
            alertify.notify(response.data.message, "warning", 6);
        }
    } catch (error) {
        console.error("Erro:", error);
        alertify.set("notifier", "position", "top-right");
        alertify.notify(
            "Não foi possível adicionar o produto. Tente novamente.",
            "error",
            2
        );
    } finally {
        button.disabled = false;
    }
}


document.addEventListener("DOMContentLoaded", function () {
    const formVendaDinheiro = document.getElementById("form-venda-dinheiro");

    formVendaDinheiro.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(formVendaDinheiro);
        formData.append("_token", token);

        const btnFinalizarVenda = document.getElementById("btn-finalizar-venda");
        btnFinalizarVenda.disabled = true;

        try {
            const response = await axios.post(urlVendaDinheiro, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });

            console.log(response.data);

            if (response.data.success) {
                verificarCaixa();
                console.log(response.data.message);

                // Imprimir recibo de venda PDF 80mm
                btnFinalizarVenda.disabled = false;
                let url = urlFaturaRecibo.replace(":id", response.data.venda_id);
                const printWindow = window.open(url, "_blank");

                printWindow.onload = function () {
                    printWindow.print();
                    setTimeout(() => {
                        printWindow.close();
                    }, 3000);
                };

               
               $("#form-venda-dinheiro").trigger("reset");
                getItensVenda();
                getMetodosPagamento();
                $("#get-produtos").DataTable().ajax.reload(null, true);
                $("#get-produtos-mobile").DataTable().ajax.reload(null, true);
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.notify(response.data.message, "error", 1, function () {
                    btnFinalizarVenda.disabled = false;
                });
            }
        } catch (error) {
            btnFinalizarVenda.disabled = false;

            // Verificando se o erro tem resposta
            if (error.response && error.response.data) {
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            const errorMessage = errors[key][0];
                            const errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = errorMessage;
                            }
                            console.log(errorMessage);
                        }
                    }

                    alertify.set("notifier", "position", "top-right");
                    alertify.notify(
                        "Por favor, selecione o método de pagamento!", "error", 2,
                        function () {
                            btnFinalizarVenda.disabled = false;
                        }
                    );
                }
            } else {
                console.log(error);
                alertify.set("notifier", "position", "top-right");
                alertify.notify("Não foi possível finalizar a venda. Tente novamente.", "error", 2);
            }
        }
    });
});


//[EVENTO] INICIALIZA O CHOICES.JS PARA OS CLIENTES
document.addEventListener("DOMContentLoaded", function () {
    initializeChoicesClientes();
    getClientes();
});
function initializeChoicesClientes() {
    $(".menu-select-clientes").each(function () {
        if ($(this).data("choicesInstance")) {
            $(this).data("choicesInstance").destroy();
        }

        let instance = new Choices(this, {
            searchEnabled: true,
            removeItemButton: false,
        });

        $(this).data("choicesInstance", instance);
        this.style.width = "300px"; // Ajusta a largura
        this.style.height = "50px"; // Ajusta a altura
    });

    console.log("Choices.js inicializado");
}

function getClientes() {
    $.ajax({
        url: urlClientes,
        method: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.success) {
                var options =
                    '<option value="" selected disabled>Nome do cliente</option>';
                $.each(response.clientes, function (index, cliente) {
                    options +=
                        '<option value="' +
                        cliente.id +
                        '" data-nuit="' +
                        cliente.nuit +
                        '" data-endereco="' +
                        cliente.endereco +
                        '">' +
                        cliente.nome +
                        "</option>";
                });

                $(".menu-select-clientes").html(options);

                initializeChoicesClientes();
            }
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
}

//[EVENTO] PARA PREENCHER OS CAMPOS NUIT E ENDEREÇO AO SELECIONAR UM CLIENTE
$(document).on("change", ".menu-select-clientes", function () {
    var selectedOption = $(this).find("option:selected");
    var nuit = selectedOption.data("nuit") || "";
    var endereco = selectedOption.data("endereco") || "";

    $("#nuit").val(nuit);
    $("#endereco").val(endereco);
});

$(document).ready(function () {
    $("#form-nova-fatura").on("submit", function (e) {
        e.preventDefault();
        $("#nuit-error").text("");
        $("#endereco-error").text("");
        $("#id_cliente_error").text("");
        $("#numero_parcelas_error").text("");
        var formData = new FormData(this);

        for (let [key, value] of formData.entries()) {
            console.log(key + ": " + value);
        }
        formData.append("_token", token);

        $.ajax({
            url: urlFinalizarVendaPrazo,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $("#btn-finalizar-venda").prop("disabled", true);
            },
            success: function (response) {
                console.log(response);
                $("#btn-finalizar-venda").prop("disabled", false);
                if (response.success) {
                    //Print recibo de venda PDF 80mm
                    var url = urlFaturaVenda.replace(":id", response.venda_id);
                    window.open(url, "_blank");
                    getItensVenda();

                    $("#form-nova-fatura")[0].reset();
                    gerarParcelas();
                    getClientes();
                } else {
                    $("#btn-finalizar-venda").prop("disabled", false);
                    Swal.fire({
                        icon: "warning",
                        position: "top",
                        text: response.message,
                        confirmButtonText: "OK",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton:
                                "btn btn-primary btn-sm me-2 fs-4 px-4 ",
                            icon: "swal2-icon-custom",
                        },
                    });
                    $("#id_cliente_error").text("");
                    $("#numero_parcelas_error").text("");
                }
            },
            error: function (xhr) {
                $("#btn-finalizar-venda").prop("disabled", false);
                console.log(xhr);
                $("#id_cliente_error").text("");
                $("#numero_parcelas_error").text("");
                $("#nuit-error").text("");
                $("#endereco-error").text("");
                if (xhr.status == 422) {
                    iziToast.warning({
                        icon: "",
                        message:
                            '<i class="fa-solid fa-circle-exclamation fs-2"></i> <span class="ms-2"> Precisa selecionar um Cliente!</span>',
                        position: "topCenter",
                        timeout: 3000,
                    });

                    $("#btn-finalizar-venda").prop("disabled", false);
                    let errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            //$('#' + key + '-error').text(errors[key][0]);
                        }
                    }
                } else {
                    iziToast.error({
                        icon: "",
                        message:
                            '<i class="fa-solid fa-circle-exclamation fs-2"></i> <span class="ms-2"> Ocorreu um erro inesperado. Tente novamente mais tarde</span>',
                        position: "topCenter",
                        timeout: 3000,
                    });
                }
            },
        });
    });
});

//[FUNÇÃO] PARA CANCELAR Fatura Recibo
function cancelarFr(button, id) {
    var $button = $(button);
    var faturaId = $button.data("id") || id;
    alertify.confirm(
        '<i class="ti ti-alert-circle text-warning fs-3 border-bottom ms-2"></i><span class="text-dark fs-5">Ação necessária!</span>',
        "Tem certeza que deseja cancelar a Fatura Recibo " + faturaId + "?",
        function () {
            $.ajax({
                url: urlCancelarFr.replace(":id", faturaId),
                type: "POST",
                data: {
                    id: faturaId,
                    _token: token,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.notify(
                            "A Fatura Recibo " +
                                faturaId +
                                " foi cancelada com sucesso!",
                            "success",
                            3
                        );
                        $("#vendas-concluidas-table")
                            .DataTable()
                            .ajax.reload(null, false);
                    } else {
                        alertify.set("notifier", "position", "top-right");
                        alertify.notify(response.message, "error", 3);
                        console.log(response);
                    }
                },
                error: function (xhr, error, thrown) {
                    console.error(xhr, error, thrown);
                    alertify.set("notifier", "position", "top-right");
                    alertify.notify(
                        "Ocorreu um erro ao cancelar a Fatura Recibo.",
                        "error",
                        3
                    );
                },
            });
        },
        function () {
            //alertify.error('Ação cancelada!');
        }
    );
}

//[FUNÇÃO] REIMPRIMIR RECIBO
function reimprimirRecibo(button, id, status) {
    
    if (status == "Cancelada") {
        alertify.set("notifier", "position", "top-right");
        alertify.notify("Impossível reimprimir o Recibo, pois a Fatura Recibo " + id + " foi cancelada!", "error", 3);
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

// Substitua setTimeout por requestAnimationFrame para animações
// Exemplo:
// Em vez de:
// setTimeout(function() { /* código pesado */ }, 500);

// Use:
if (window.requestIdleCallback) {
    requestIdleCallback(function() {
        // código de animação aqui
    });
} else {
    // Fallback para navegadores que não suportam requestIdleCallback
    setTimeout(function() {
        // código pesado aqui
    }, 1);
}

// Para código não relacionado a animações que precisa de atraso:
// Divida tarefas grandes em partes menores
function executarTarefaGrande(dados, indice, tamanhoLote) {
    // Processa um lote de dados
    const fim = Math.min(indice + tamanhoLote, dados.length);
    for (let i = indice; i < fim; i++) {
        // Processa dados[i]
    }
    
    // Se ainda houver dados para processar, agende o próximo lote
    if (fim < dados.length) {
        setTimeout(function() {
            executarTarefaGrande(dados, fim, tamanhoLote);
        }, 0);
    }
}


// Configuração dos offcanvas e seus botões
const offcanvasConfig = {
    btnPrescricoes: 'offcanvasPrescricoes',
    btnConfirmar: 'offcanvasFecharVenda',
    btnProdutos: 'offcanvasProdutos'
};

// Função para fechar todos os offcanvas
function closeAll() {
    Object.values(offcanvasConfig).forEach(offcanvasId => {
        document.getElementById(offcanvasId)?.classList.add('hidden');
    });
}

// Inicialização dos event listeners
document.addEventListener('DOMContentLoaded', () => {
    Object.entries(offcanvasConfig).forEach(([buttonId, offcanvasId]) => {
        document.getElementById(buttonId)?.addEventListener('click', () => {
            closeAll();
            document.getElementById(offcanvasId)?.classList.remove('hidden');
        });
    });
});
