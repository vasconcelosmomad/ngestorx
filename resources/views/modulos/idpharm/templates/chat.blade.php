<!-- Barra de status do chat -->
<div class="fixed top-14 left-0 w-full bg-white shadow-sm z-5 ">
  <div class="container mx-auto max-w-2xl px-2 py-2 flex items-center justify-between">
    <h1 class="text-base sm:text-lg font-semibold">Suporte Técnico</h1>
    <div class="flex items-center gap-1 text-sm text-gray-600">
      <button onclick="openNewTicketModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
      + Novo Ticket
      </button>
    </div>
  </div>
</div>
<div class=" bg-gray-100 w-full h-screen">
  <main class="pt-32 pb-28 px-4 max-w-screen-xl mx-auto">
    <!-- Conteúdo do chat -->
    <div class="flex-1 overflow-y-auto container mx-auto max-w-2xl">
      <!-- Lista de Tickets -->
      <div class="space-y-4" id="ticketList">
      </div>
    </div>
</div>
</main>
</div>
@include('components.footer')
<!-- Modal para Detalhes do Ticket -->
<div id="ticketDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
  <form id="replyForm" class="w-full h-full sm:h-[600px] sm:max-w-3xl sm:rounded-lg bg-white overflow-hidden flex flex-col shadow-xl">
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center border-b px-6 py-4">
      <h3 class="text-xl font-semibold text-gray-900" id="ticketTitle">Detalhes do Ticket</h3>
      <button type="button" onclick="closeTicketDetailsModal()" class="text-gray-400 hover:text-gray-500">
      <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    <!-- Corpo (Histórico de Mensagens) -->
    <div class="p-6 overflow-y-auto flex-1 bg-white/80 backdrop-blur-sm" id="messageHistory">
      <!-- As mensagens serão carregadas dinamicamente -->
    </div>
    <!-- Rodapé com campo de resposta -->
    <div class="border-t p-2 bg-white">
      <div class="flex items-center gap-2 bg-white rounded-xl p-1.5 border">
        <!-- Área de texto -->
        <div class="flex-1">
          <textarea name="menssagem" rows="4" placeholder="Digite sua mensagem..."
            class="w-full px-2 py-1.5 bg-transparent border-0 focus:ring-0 focus:outline-none resize-none text-sm text-gray-700 placeholder-gray-400"></textarea>
        </div>
        <!-- Área de botões -->
        <div class="flex items-center gap-2 px-2">
          <!-- Upload -->
          <label class="flex items-center gap-2 text-blue-500 cursor-pointer hover:text-blue-700 transition-colors">
          <i data-lucide="paperclip" class="w-5 h-5"></i>
          <input type="file" name="attachment" class="hidden" id="replyAttachment"
            onchange="updateFileNameDisplay(this, 'fileNameDisplay')">
          </label>
          <!-- Nome do arquivo -->
          <span id="fileNameDisplay" class="text-xs text-gray-500 truncate max-w-[120px]"></span>
          <!-- Botão Enviar -->
          <button type="submit" id="replySubmit" form="replyForm"
            class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500 hover:bg-blue-600 text-white text-sm transition-colors">
          <i data-lucide="send" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Modal para Novo Ticket -->
<div id="newTicketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
<div class="bg-white w-full h-full overflow-hidden flex flex-col 
  rounded-none sm:rounded-lg shadow-xl sm:max-w-3xl md:max-w-md sm:h-[400px] overflow-hidden">
  <div class="flex justify-between items-center border-b px-6 py-4">
    <h3 class="text-xl font-semibold text-gray-900">Novo Ticket de Suporte</h3>
    <button onclick="closeNewTicketModal()" class="text-gray-400 hover:text-gray-500">
    <i data-lucide="x" class="w-5 h-5"></i>
    </button>
  </div>
  <div class="p-6 overflow-y-auto flex-1">
    <form id="newTicketForm" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Assunto</label>
        <input type="text" class="w-full border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Digite o assunto do ticket">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
        <select class="w-full border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500 text-sm">
          <option value="low">Baixa</option>
          <option value="medium">Média</option>
          <option value="high">Alta</option>
          <option value="critical">Crítica</option>
        </select>
      </div>
    </form>
  </div>
  <div class="border-t p-2 bg-white">
    <div class="flex items-center gap-2 bg-white rounded-xl p-1.5 border">
      <!-- Área de texto -->
      <div class="flex-1">
        <textarea name="descricao" form="newTicketForm" rows="4"
          class="w-full px-2 py-1.5 bg-transparent border-0 focus:ring-0 focus:outline-none resize-none text-sm text-gray-700 placeholder-gray-400"
          placeholder="Descreva detalhadamente o problema..."></textarea>
      </div>
      <!-- Área de botões -->
      <div class="flex items-center gap-2 px-2">
        <label class="flex items-center gap-2 text-blue-500 cursor-pointer hover:text-blue-700 transition-colors">
        <i data-lucide="paperclip" class="w-5 h-5"></i>
        <input type="file" class="hidden" id="newTicketAttachment" form="newTicketForm" 
          onchange="updateFileNameDisplay(this, 'newTicketFileDisplay')">
        </label>
        <span id="newTicketFileDisplay" class="text-xs text-gray-500 truncate max-w-[120px]"></span>
        <button type="submit" id="newTicketSubmit" form="newTicketForm" 
          class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500 hover:bg-blue-600 text-white text-sm transition-colors">
        <i data-lucide="send" class="w-4 h-4"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@vite(['resources/js/app.js'])
<style>
  /* Estilo para ocultar a barra de rolagem mas manter a funcionalidade */
  textarea {
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE e Edge */
  }
  /* Webkit (Chrome, Safari, Opera) */
  textarea::-webkit-scrollbar {
  display: none;
  }
</style>
<script>
  // Função para mostrar o nome do arquivo selecionado
  function updateFileNameDisplay(input, displayId) {
    const displayElement = document.getElementById(displayId);
    if (input.files && input.files[0]) {
      const fileName = input.files[0].name;
      displayElement.textContent = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
    } else {
      displayElement.textContent = '';
    }
  }
  
  
  
  function closeTicketDetailsModal() {
    document.getElementById('ticketDetailsModal').classList.add('hidden');
    // Limpar o formulário
    document.getElementById('replyForm').reset();
    document.getElementById('fileNameDisplay').textContent = '';
  }
  
  function openNewTicketModal() {
    document.getElementById('newTicketModal').classList.remove('hidden');
    // Limpar qualquer nome de arquivo exibido anteriormente
    document.getElementById('newTicketFileDisplay').textContent = '';
  }
  
  function closeNewTicketModal() {
    document.getElementById('newTicketModal').classList.add('hidden');
    // Limpar o formulário
    document.getElementById('newTicketForm').reset();
    document.getElementById('newTicketFileDisplay').textContent = '';
  }
  
  
  
  //LISTAR OS TIKETS
  var urlTickets = "{{ route('support.tickets') }}";
  document.addEventListener('DOMContentLoaded', function () {
    // Referência ao elemento que conterá os tickets
    var ticketList = document.getElementById('ticketList');
    
    axios.get(urlTickets)
        .then(function (response) {
            //console.log(response.data);
            var tickets = response.data.data;
            
            if (tickets.length === 0) {
                // Exibir mensagem se não houver tickets
                var noTicketsElement = document.createElement('div');
                noTicketsElement.classList.add('bg-white', 'rounded-2xl', 'shadow-md', 'p-4', 'text-center');
                noTicketsElement.innerHTML = '<p class="text-gray-500">Nenhum ticket de suporte encontrado.</p>';
                ticketList.appendChild(noTicketsElement);
                return;
            }
            
            tickets.forEach(function(ticket) {
                var ticketElement = document.createElement('div');
                ticketElement.classList.add('bg-white', 'rounded-2xl', 'shadow-md', 'p-4', 'mb-4');
                
                // Determinar o ícone e cor com base no status
                var iconClass, bgColorClass, textColorClass, statusBgClass, statusTextClass, statusText;
                
                if (ticket.status === 'fechado') {
                    iconClass = 'check-circle';
                    bgColorClass = 'bg-green-100';
                    textColorClass = 'text-green-600';
                    statusBgClass = 'bg-green-200';
                    statusTextClass = 'text-green-800';
                    statusText = 'Resolvido';
                } else if (ticket.status === 'em_andamento') {
                    iconClass = 'alert-triangle';
                    bgColorClass = 'bg-yellow-100';
                    textColorClass = 'text-yellow-600';
                    statusBgClass = 'bg-yellow-200';
                    statusTextClass = 'text-yellow-800';
                    statusText = 'Em andamento';
                } else {
                    iconClass = 'help-circle';
                    bgColorClass = 'bg-blue-100';
                    textColorClass = 'text-blue-600';
                    statusBgClass = 'bg-blue-200';
                    statusTextClass = 'text-blue-800';
                    statusText = 'Aberto';
                }
                
                // Formatação da data
                var createdDate = new Date(ticket.created_at);
                var formattedDate = createdDate.toLocaleDateString('pt-BR');
                
                // Verificar se há anexo
                var hasAttachment = ticket.attachment !== null;
                
                ticketElement.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="${bgColorClass} ${textColorClass} p-2 rounded-full">
                                <i data-lucide="${iconClass}" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="font-semibold text-gray-800">${ticket.title}</h2>
                                <p class="text-sm text-gray-500">#${ticket.id}</p>
                            </div>
                        </div>
                        <span class="text-sm ${statusBgClass} ${statusTextClass} px-2 py-1 rounded-full">${statusText}</span>
                    </div>
  
                    <p class="mt-2 text-sm text-gray-600">${ticket.menssagem || ''}</p>
  
                    ${hasAttachment ? `
                    <div class="mt-3 flex items-center gap-2 text-sm text-gray-500">
                        <i data-lucide="paperclip" class="w-4 h-4"></i>
                        <span>1 anexo</span>
                    </div>
                    ` : ''}
  
                    <div class="flex justify-between items-center mt-4 mb-2 text-sm text-gray-500">
                        <span>Aberto em: ${formattedDate}</span>
                        <button onclick="openTicketDetailsModal('${ticket.id}')" class="text-blue-600 font-medium hover:underline">Ver detalhes</button>
                    </div>
                `;
                
                ticketList.appendChild(ticketElement);
                lucide.createIcons()
              
            });
            
        })
        .catch(function (error) {
            console.error('Erro ao buscar os tickets:', error);
            // Exibir mensagem de erro
            var errorElement = document.createElement('div');
            errorElement.classList.add('bg-red-100', 'text-red-700', 'p-4', 'rounded-lg', 'mb-4');
            errorElement.textContent = 'Erro ao carregar os tickets. Por favor, tente novamente mais tarde.';
            ticketList.appendChild(errorElement);
        });
  });
  
  // Inicializar os ícones Lucide
  $(document).ready(function() {
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
    
  
  
  });
  
  
  var urlTicket = "{{ route('support.ticket.show', ':id') }}";  
  function openTicketDetailsModal(ticketId){
  // Limpar o histórico de mensagens existente
  const messageHistory = document.getElementById('messageHistory');
  messageHistory.innerHTML = '';
  
  // Mostrar indicador de carregamento
  messageHistory.innerHTML = '<div class="flex justify-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div></div>';
  
  // Abrir a modal
  document.getElementById('ticketDetailsModal').classList.remove('hidden');
  
  // Buscar os detalhes do ticket
  axios.get(urlTicket.replace(':id', ticketId))
  .then(function (response) {
    console.log(response.data);
    
    if (response.data.status === 'success' && response.data.data.length > 0) {
      // Limpar o indicador de carregamento
      messageHistory.innerHTML = '';
      
      // Atualizar o título do ticket
      const ticketTitle = document.getElementById('ticketTitle');
      ticketTitle.textContent = response.data.data[0].title;
      
      // Adicionar um badge de status
      let statusClass = '';
      let statusText = '';
      
      switch(response.data.data[0].status) {
        case 'aberto':
          statusClass = 'bg-yellow-100 text-yellow-800';
          statusText = 'Aberto';
          break;    
        case 'em_andamento':
          statusClass = 'bg-blue-100 text-blue-800';
          statusText = 'Em Andamento';
          break;
        case 'fechado':
          statusClass = 'bg-green-100 text-green-800';
          statusText = 'Resolvido';
          break;
        default:
          statusClass = 'bg-gray-100 text-gray-800';
          statusText = response.data.data[0].status;
      }
      
      ticketTitle.innerHTML = `${response.data.data[0].title} <span class="ml-2 text-xs font-medium px-2 py-1 rounded-full ${statusClass}">${statusText}</span>`;
      
      // Preencher o histórico de mensagens
      let currentDate = '';
      
      response.data.data.forEach(function(message) {
        const date = new Date(message.created_at);
        const formattedDate = date.toLocaleString('pt-BR');
        
        // Extrair apenas a data (sem a hora) para comparação
        const messageDate = date.toLocaleDateString('pt-BR');
        
        // Formatar a data no estilo "12 de Maio de 2025"
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        const formattedMessageDate = date.toLocaleDateString('pt-BR', options);
        
        // Se a data for diferente da atual, adicionar um separador
        if (messageDate !== currentDate) {
          currentDate = messageDate;
          
          // Criar o separador de data
          const dateSeparator = document.createElement('div');
          dateSeparator.classList.add('flex', 'items-center', 'justify-center', 'my-4');
          dateSeparator.innerHTML = `
            <div class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">
              ${formattedMessageDate}
            </div>
          `;
          
          messageHistory.appendChild(dateSeparator);
        }
        
        // Determinar se a mensagem é do usuário ou do suporte
        const isSupport = message.is_support; // Ajuste conforme sua lógica
        
        const messageElement = document.createElement('div');
        messageElement.classList.add('flex', 'items-start', 'gap-3');
        
        messageElement.innerHTML = `
  <div class="bg-${isSupport ? 'green' : 'blue'}-100 rounded-full flex-shrink-0  p-2">
    <input type="hidden" name="ticket_id" value="${message.id}">
    <i data-lucide="${isSupport ? 'headset' : 'user'}" class="w-5 h-5 text-${isSupport ? 'green' : 'blue'}-600"></i>
  </div>
  <div class="flex-1 mb-2"> 
    <div class="p-2 text-sm ${isSupport ? 'bg-green-100 rounded-2xl rounded-bl-none ' : 'bg-blue-50 rounded-2xl rounded-br-none '}">
      <div class="flex justify-between items-center mb-1">
        <p class="font-medium text-sm">${isSupport ? 'Suporte Técnico' : 'Você'}</p>
        <span class="text-xs text-gray-500">${formattedDate.split(' ')[1]}</span>
      </div>
      <p class="text-sm break-words">${message.menssagem}</p>
      ${message.attachment ? `
        <div class="mt-2 flex items-center gap-2">
          <i data-lucide="paperclip" class="w-4 h-4 text-gray-500"></i>
          <a href="/storage/${message.attachment}" target="_blank" class="text-sm text-blue-600 hover:underline">Ver anexo</a>
        </div>
      ` : ''}
    </div>
  </div>
  `;
        
        messageHistory.appendChild(messageElement);
      });
      
      // Configurar o formulário de resposta
      const replyForm = document.getElementById('replyForm');
      replyForm.setAttribute('data-ticket-id', ticketId);
      
      // Inicializar os ícones Lucide para os novos elementos
      lucide.createIcons();
      
      // Rolar para o final do histórico
      messageHistory.scrollTop = messageHistory.scrollHeight;
    } else {
      // Exibir mensagem de erro se não houver dados
      messageHistory.innerHTML = '<div class="p-4 bg-red-50 text-red-600 rounded-lg">Não foi possível carregar os detalhes do ticket.</div>';
    }
  })
  .catch(function (error) {
    console.log(error);
    // Exibir mensagem de erro
    messageHistory.innerHTML = '<div class="p-4 bg-red-50 text-red-600 rounded-lg">Erro ao carregar os detalhes do ticket. Por favor, tente novamente.</div>';
  });
  }
  
  function closeTicketDetailsModal() {
  document.getElementById('ticketDetailsModal').classList.add('hidden');
  }
  
  
  var urlReply = "{{ route('support.ticket.reply') }}";
  $("#replyForm").submit(function(e) {
    e.preventDefault();
  
    // Desabilitar o botão de envio para evitar múltiplos envios
    const submitButton = document.getElementById('replySubmit');
    if (submitButton.disabled) {
      return; // Se o botão já estiver desabilitado, não prosseguir
    }
    
    // Desabilitar o botão e alterar aparência
    submitButton.disabled = true;
    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
    
    const form = $(this)[0];
    const formData = new FormData(form);
  
    // Mostrar os dados no console
    for (let [key, value] of formData.entries()) {
     // console.log(`${key}:`, value);
    }
    axios.post(urlReply, formData)
  .then(response => {
  console.log(response.data);
  
  const reply = response.data.data;
  form.reset();
  
  // Substituir o input de arquivo para garantir que limpe
  const fileInput = form.querySelector('input[type="file"]');
  if (fileInput) {
    const newInput = fileInput.cloneNode();
    fileInput.parentNode.replaceChild(newInput, fileInput);
  }
  
  // Limpar o nome do arquivo exibido
  const fileNameDisplay = document.getElementById('fileNameDisplay');
  if (fileNameDisplay) {
    fileNameDisplay.textContent = "";
  }
  console.log(reply.support_ticket_id);
  openTicketDetailsModal(reply.support_ticket_id);
  
  // Reabilitar o botão após o sucesso
  submitButton.disabled = false;
  submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
  
  })
  .catch(error => {
  console.error("Erro:", error);
  if (error.response && error.response.data) {
    console.error("Detalhes do erro:", error.response.data);
  }
  
  // Reabilitar o botão em caso de erro
  submitButton.disabled = false;
  submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
  });
  
  });
</script>