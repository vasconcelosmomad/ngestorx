<?php
namespace App\Http\Controllers;

use Samuelbie\Mpesa\Transaction;
use App\Services\MpesaConfig;
use Illuminate\Http\Request;
use App\Models\Plano;
use App\Models\Empresa;
use App\Models\Pagamento;
class MpesaController extends Controller
{
    public function sendMpesaPayment(Request $request)
    {
        try {
            // Validar dados da requisição
            $request->validate([
                'phone' => 'nullable|string|regex:/^[8-9][0-9]{8}$/',
                'plano_id' => 'nullable|integer',
                'uid_empresa' => 'nullable|string',
                'metodo_pagamento_id' => 'nullable|integer'
            ]);

            if($request->input('phone') == ''){
                return response()->json([
                    'success' => false,
                    'message' => 'Preencher o número de telefone'
                ]);
            }

            if($request->input('plano_id') == ''){
                return response()->json([
                    'success' => false,
                    'message' => 'Selecione o plano'
                ]);
            }   

            if($request->input('uid_empresa') == ''){
                return response()->json([
                    'success' => false,
                    'message' => 'Preencher o UID-Empresa'
                ]);
            }

            if($request->input('metodo_pagamento_id') == ''){
                return response()->json([
                    'success' => false,
                    'message' => 'Selecione a forma de pagamento'
                ]);
            }
            $plano = Plano::select('*')->where('id', $request->input('plano_id'))->first();
            $empresa = Empresa::select('*')->where('id', $request->input('uid_empresa'))->first();

            if (!$plano) {
                return response()->json([
                    'success' => false,
                    'message' => 'Plano não encontrado'
                ]);
            }

            if (!$empresa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Empresa não encontrada, verifique o UID-Empresa e tente novamente'
                ]);
            }

            $amount = $plano->valor;
            $phone = '258'.$request->input('phone');
            
            // Validar formato do número
            if (!preg_match('/^258[8-9][0-9]{8}$/', $phone)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Número de telefone inválido. Deve começar com 258 seguido de 8 ou 9 e mais 8 dígitos.'
                ]);
            }
            
            $transaction_reference = 'T' . time();
            $third_party_reference = 'VBCNZB'. rand(100, 999);

            // Configuração do Mpesa
            $config = new MpesaConfig();
            
          
            $mpesa = new Transaction($config);
            
            // Aumentar timeout para 60 segundos
            ini_set('default_socket_timeout', 60);

            $response = $mpesa->c2b(
                $amount,
                $phone,
                $transaction_reference,
                $third_party_reference
            );
            $data_assinatura = date('Y-m-d');
            $meses = $plano->duracao_meses;
            
            $data_expiracao = date('Y-m-d', strtotime("+$meses months", strtotime($data_assinatura)));
            
            if($response->getStatusCode() == 200 or $response->getStatusCode() == 201){
                Empresa::where('id', $empresa->id)->update([
                    'status' => 'Ativa',
                    'data_validade' => $data_expiracao,
                    'plano_id' => $plano->id
                ]);

             
                $pagamento = Pagamento::create([
                    'empresa_id' => $empresa->id,
                    'plano_id' => $plano->id,
                    'data' => date('Y-m-d'),
                    'status' => 'Pago',
                    'metodo_pagamento' => $request->input('metodo_pagamento_id')
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Pagamento processado com sucesso',
                    'pagamento_id' => $pagamento->id
                    //'response' => $response->getBody()
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao processar pagamento',
                    'error' => $response->getBody()
                ], 500);
            }
         }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar pagamento',
                'error' => $e->getMessage()
            ], 500);
         }
      }
          
}
