<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\DB;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewTicketReply;

class SupportTicketController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    /**
     * Lista todos os tickets de suporte
     */
    public function index()
    {
        $user_id = session('id_usuario');
        $uid_empresa = session('uid_empresa');
        
        $tickets = DB::table('support_tickets')
            ->join(DB::raw('(SELECT * FROM chat_messages cm1 
                             WHERE created_at = (
                                 SELECT MIN(created_at) 
                                 FROM chat_messages cm2 
                                 WHERE cm2.support_ticket_id = cm1.support_ticket_id
                             )
                           ) as first_messages'),
                  'support_tickets.id', '=', 'first_messages.support_ticket_id')
            ->where('support_tickets.usuario_id', $user_id)
            ->where('support_tickets.uid_empresa', $uid_empresa)
            ->select(
                'support_tickets.id',
                'support_tickets.title',
                'support_tickets.status',
                'first_messages.menssagem',
                'first_messages.attachment',
                'first_messages.created_at'
            )
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }


    /**
     * Exibe detalhes de um ticket específico com suas mensagens
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $user_id = session('id_usuario');
        $uid_empresa = session('uid_empresa');
    
        $tickets = DB::table('support_tickets')
            ->join('chat_messages', 'support_tickets.id', '=', 'chat_messages.support_ticket_id')
            ->where('support_tickets.usuario_id', $user_id)
            ->where('support_tickets.uid_empresa', $uid_empresa)
            ->where('support_tickets.id', $id)
            ->orderBy('chat_messages.created_at', 'asc') // mensagens em ordem cronológica
            ->select(
                'support_tickets.id',
                'support_tickets.title',
                'support_tickets.status',
                'chat_messages.menssagem',
                'chat_messages.attachment',
                'chat_messages.created_at',
                'chat_messages.is_read',
                'chat_messages.is_support',
            )
            ->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }
    

    /**
     * Adiciona uma nova mensagem a um ticket existente
     */
    public function replyMessage(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:support_tickets,id',
            'menssagem' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        $uid_empresa = session('uid_empresa');
        
        
        $user_id = session('id_usuario');
        $name = session('nome_usuario');
        $attachmentPath = null;

        // Buscar o ticket
        $ticket = SupportTicket::findOrFail($request->ticket_id);

        // Processar o arquivo de anexo, se enviado
        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('ticket_attachments', 'public');
        }

        // Criar a mensagem
        $message = ChatMessage::create([
            'usuario_id' => $user_id,
            'menssagem' => $request->menssagem,
            'attachment' => $attachmentPath,
            'is_read' => false,
            'support_ticket_id' => $ticket->id,
            'is_support' => false,
        ]);

        // Atualizar o timestamp da última resposta do ticket
        $ticket->update([
            'last_reply_at' => now(),
            'status' => 'em_andamento' // Atualizar o status se necessário
        ]);

        // Enviar email para o suporte técnico
        try {
            $emailSuporte = config('mail.support_email', 'suporte@exemplo.com');
            
            // Preparar os dados para o email
            $emailData = [
                'ticket_id' => $ticket->id,
                'ticket_title' => $ticket->title,
                'user_name' => $name,
                'message' => $request->menssagem,
                'attachment' => $attachmentPath,
                'created_at' => now()->format('d/m/Y H:i:s'),
            ];
            
            // Enviar o email
            Mail::to($emailSuporte)->send(new NewTicketReply($emailData));
            
            // Log de sucesso
            \Log::info('Email de notificação enviado para o suporte técnico', [
                'ticket_id' => $ticket->id,
                'email' => $emailSuporte
            ]);
        } catch (\Exception $e) {
            // Log de erro
            \Log::error('Erro ao enviar email para o suporte técnico', [
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage()
            ]);
            
            // Não interromper o fluxo em caso de erro no envio do email
        }

        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }

    /**
     * Atualiza o status de um ticket
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $uid_empresa = session('uid_empresa');

        
        $ticket = SupportTicket::findOrFail($request->id);
        
        $ticket->update([
            'status' => $request->status,
            'closed_at' => $request->status === 'closed' ? now() : null
        ]);
        
        return response()->json([
            'status' => 'success',
            'data' => $ticket
        ]);
    }
}
