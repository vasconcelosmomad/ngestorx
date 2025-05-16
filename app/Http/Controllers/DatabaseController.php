<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DatabaseController extends Controller
{
    // Função de login usando Eloquent
    public function login(Request $request)
    {
        try {
            $uid_empresa = $request->input('uid_empresa');
            $username = $request->input('username');
            $password = $request->input('password');
            $modulo = $request->input('modulo');
            if($modulo == null) {
                return response()->json(['error' => 'Modulo não selecionado'], 422);
            }

            // Usando Eloquent para buscar a empresa
            $empresa = new Empresa();
            $empresa = $empresa->where('id', $uid_empresa)->first();
            if (!$empresa) {
                return response()->json(['error' => 'Empresa não encontrada, por favor verifique o UID da empresa'], 422);
            }

            // Adicionando logs para debug
            \Log::info('Modulo recebido: ' . $modulo);
            \Log::info('Modulo da empresa: ' . $empresa->modulo_id);
            
            // Convertendo ambos os valores para string antes da comparação
            $modulo = (string)$modulo;
            $empresa_modulo = (string)$empresa->modulo_id;
            
            if($empresa_modulo !== $modulo) {
                return response()->json([
                    'error' => 'O Módulo selecionado não corresponde ao módulo da empresa',
                    'modulo_recebido' => $modulo,
                    'modulo_empresa' => $empresa->modulo_id
                ], 422);
            }

            if ($empresa->status !== 'Ativa') {
                return response()->json(['error' => 'Empresa está inativa, por favor verifique com o administrador do sistema'], 422);
            }

            // Agora que a empresa está verificada, conecte-se ao banco de dados da empresa
            $this->setEmpresaDatabaseConnection($empresa);
            $uid_software = $modulo;
            $idpharm = env('IDPHARM');
            $restgo = env('RESTGO');
            $flexity = env('FLEXITY');

            $tables = [
                $idpharm => ['usuarios', 'funcionarios'],
                $restgo => ['usuarios', 'funcionarios'],
                $flexity => ['usuarios', 'funcionarios'],
            ];

            $table = $tables[$uid_software][0];
            $table_funcionario = $tables[$uid_software][1];
            // Usando Eloquent para buscar o usuário
            $usuario = new Usuario();
            $usuario->setTable($table);
            $usuario = $usuario
            ->where('usuario', $username)
            ->where('status', 'Ativo')
            ->first();

            if (!$usuario) {
                return response()->json(['error' => 'Acesso negado!'], 422);
            }

            $funcionario = new Funcionario();
            $funcionario->setTable($table_funcionario);
            $funcionario = $funcionario->where('id', $usuario->id_funcionario)->first();
            $cargo = new Cargo();
            $cargo = $cargo->where('id', $funcionario->cargo_id)->first();

            // Verifica se a conta está ativa
            if (!$usuario->is_active) {
                return response()->json(['error' => 'A conta foi desativada por razões de segurança. Por favor, solicite reativação ao administrador do sistema.'], 422);
            }

            // Verifica se a senha está criptografada corretamente  
            if (Hash::info($usuario->password)['algoName'] !== 'bcrypt') {
                $usuario->password = Hash::make($usuario->password);
                $usuario->save();
            }


                // Verifica se a senha informada é correta
            if (Hash::check($password, $usuario->password)) {
                // Zera tentativas falhas
                $usuario->failed_attempts = 0;
                $usuario->save();
                // Armazenando os dados do usuário e empresa na sessão
                session()->put('uid_empresa', $uid_empresa);
                session()->put('software_id', $uid_software);
                session()->put('nome_usuario', $funcionario->nome);
                session()->put('nivel_acesso', $usuario->nivel);
                session()->put('id_usuario', $funcionario->id);
                session()->put('nivel_usuario', $usuario->nivel);
                session()->put('empresa', $empresa);
                session()->put('cargo', $cargo->nome);


                $page = "dashboard";
                return response()->json(['success' => true, 'redirect' => route('painel.index', ['page' => $page])], 200);
            } else {
                // Incrementa tentativas falhas
                $usuario->failed_attempts += 1;
                
                // Bloqueia se atingiu 3 tentativas
                if ($usuario->failed_attempts >= 3) {
                    $usuario->is_active = 0;    // Bloqueia conta
                }
                
                $usuario->save();
                
                return response()->json(['error' => 'Usuário ou senha inválidos'], 422);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }


    public function empresaLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $usuario = User::where('email', $email)->first();
    
        if (!$usuario) {
            return back()->with('error', 'Usuário ou senha inválidos')->with('loginOpen', true);
        }
    
        // Verifica se a conta está ativa
        if (!$usuario->is_active) {
            return back()->with('error', 'A conta foi desativada por razões de segurança. Por favor, solicite reativação ao administrador do sistema.')->with('loginOpen', true);
        }
    
        // Verifica se a senha está criptografada corretamente
        if (Hash::info($usuario->password)['algoName'] !== 'bcrypt') {
            $usuario->password = Hash::make($usuario->password);
            $usuario->save();
        }
    
        // Verifica se a senha informada é correta
        if (Hash::check($password, $usuario->password)) {
            // Zera tentativas falhas
            $usuario->failed_attempts = 0;
            $usuario->save();
    
            // Inicia a sessão
            session()->put('nome_usuario', $usuario->name);
            session()->put('nivel_acesso', $usuario->plano_id);
            session()->put('id_usuario', $usuario->id);
            session()->put('nivel_usuario', $usuario->plano_id);
    
            // Redireciona conforme o nível
            switch ($usuario->nivel) {
                case 'Admin':
                    $page = 'Admin-Dashboard';
                    break;
                case 'Cliente':
                    $page = 'Cliente-Dashboard';
                    break;
                default:
                    return back()->with('error', 'Nível de acesso inválido.');
            }
    
            return redirect()->route('painel.index', ['page' => $page]);
        } else {
            // Incrementa tentativas falhas
            $usuario->failed_attempts += 1;
    
            // Bloqueia se atingiu 3 tentativas
            if ($usuario->failed_attempts >= 3) {
                $usuario->is_active = 0; // Bloqueia conta
            }
    
            $usuario->save();
    
            return back()->with('error', 'Usuário ou senha inválidos')->with('loginOpen', true);
        }
    }


    public function backupBancoComSenha()
    {
        try {
            // Verificar se a empresa existe na sessão
            $empresa = session('empresa');
            if (!$empresa) {
                return back()->with('error', 'Sessão da empresa não encontrada. Por favor, faça login novamente.');
            }
            
            // Informações do banco de dados
            $database = $empresa->db_name;
            $username = $empresa->db_user;
            $password = $empresa->db_password;
            $host = $empresa->db_host;
            $zip_password = $empresa->zip_password;
            
            // Registrar informações para depuração
            \Log::info("Iniciando backup para: {$database} em {$host}");
            
            // Configurar conexão específica para o banco de dados da empresa
            config([
                'database.connections.backup_connection' => [
                    'driver' => 'mysql',
                    'host' => $host,
                    'port' => '3306',
                    'database' => $database,
                    'username' => $username,
                    'password' => $password,
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
                ]
            ]);
            
            // Testar a conexão
            try {
                \DB::connection('backup_connection')->getPdo();
                \Log::info("Conexão com o banco bem-sucedida!");
            } catch (\Exception $e) {
                \Log::error("Erro na conexão: " . $e->getMessage());
                return back()->with('error', 'Não foi possível conectar ao banco de dados: ' . $e->getMessage());
            }
            
            // Definir caminhos e nomes de arquivos
            $timestamp = now()->format('Ymd_His');
            $filename = "backup_{$database}_{$timestamp}.sql";
            $encryptedFilename = "backup_{$database}_{$timestamp}.enc";
            $zipFilename = "backup_{$database}_{$timestamp}.zip";
            $sqlPath = storage_path("app/backups/{$filename}");
            $encryptedPath = storage_path("app/backups/{$encryptedFilename}");
            $zipPath = storage_path("app/backups/{$zipFilename}");
            
            // Criar diretório de backups se não existir
            if (!File::exists(storage_path('app/backups'))) {
                File::makeDirectory(storage_path('app/backups'), 0755, true);
            }
            
            // Obter todas as tabelas do banco de dados
            $tables = \DB::connection('backup_connection')
                ->select('SHOW TABLES');
            
            $tableField = "Tables_in_" . $database;
            
            // Iniciar o arquivo SQL
            $sql = "-- Backup do banco {$database} gerado em " . now() . "\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
            
            // Para cada tabela, obter a estrutura e os dados
            foreach ($tables as $table) {
                $tableName = $table->$tableField;
                \Log::info("Processando tabela: {$tableName}");
                
                // Obter a estrutura da tabela
                $createTable = \DB::connection('backup_connection')
                    ->select("SHOW CREATE TABLE `{$tableName}`");
                
                $sql .= "-- Estrutura da tabela `{$tableName}`\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                $sql .= $createTable[0]->{"Create Table"} . ";\n\n";
                
                // Obter os dados da tabela
                $rows = \DB::connection('backup_connection')
                    ->table($tableName)
                    ->get();
                
                if (count($rows) > 0) {
                    $sql .= "-- Dados da tabela `{$tableName}`\n";
                    $sql .= "INSERT INTO `{$tableName}` VALUES ";
                    
                    $rowsValues = [];
                    foreach ($rows as $row) {
                        $values = [];
                        foreach ((array)$row as $value) {
                            if (is_null($value)) {
                                $values[] = "NULL";
                            } else {
                                $values[] = "'" . addslashes($value) . "'";
                            }
                        }
                        $rowsValues[] = "(" . implode(", ", $values) . ")";
                    }
                    
                    $sql .= implode(",\n", $rowsValues) . ";\n\n";
                }
            }
            
            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
            
            // Salvar o SQL em um arquivo
            file_put_contents($sqlPath, $sql);
            
            \Log::info("Backup SQL criado com sucesso: {$sqlPath}");
            
            // Criptografar o arquivo SQL
            $encryptionKey = substr(hash('sha256', $zip_password, true), 0, 32); // Gerar uma chave de 256 bits a partir da senha
            $iv = random_bytes(16); // Vetor de inicialização para AES-256-CBC
            
            // Ler o conteúdo do arquivo SQL
            $sqlContent = file_get_contents($sqlPath);
            
            // Criptografar o conteúdo
            $encryptedContent = openssl_encrypt($sqlContent, 'AES-256-CBC', $encryptionKey, 0, $iv);
            
            // Adicionar o IV no início do conteúdo criptografado para poder descriptografar depois
            $encryptedContentWithIV = base64_encode($iv) . '|' . $encryptedContent;
            
            // Salvar o conteúdo criptografado
            file_put_contents($encryptedPath, $encryptedContentWithIV);
            
            \Log::info("Backup criptografado com sucesso: {$encryptedPath}");
            
            // Agora vamos compactar o arquivo com senha
            $zipPassword = $zip_password;
            
            // Tentar usar a classe ZipArchive primeiro
            if (class_exists('ZipArchive')) {
                \Log::info("Usando ZipArchive para compactar");
                
                $zip = new \ZipArchive();
                
                if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                    // Adicionar o arquivo criptografado ao ZIP
                    $zip->addFile($encryptedPath, basename($encryptedPath));
                    
                    // Adicionar um arquivo README com instruções de como descriptografar
                    $readmeContent = "Este backup foi criptografado para maior segurança.\n";
                    $readmeContent .= "Para descriptografar, use a função de restauração do sistema ou entre em contato com o suporte.\n";
                    $readmeContent .= "Data de criação: " . now()->format('d/m/Y H:i:s') . "\n";
                    $readmeContent .= "Banco de dados: {$database}\n";
                    
                    $zip->addFromString('README.txt', $readmeContent);
                    
                    // Definir senha para o arquivo (disponível no PHP 7.2+)
                    if (method_exists($zip, 'setPassword')) {
                        $zip->setPassword($zipPassword);
                        // Criptografar os arquivos adicionados
                        $zip->setEncryptionName(basename($encryptedPath), \ZipArchive::EM_AES_256);
                        $zip->setEncryptionName('README.txt', \ZipArchive::EM_AES_256);
                    }
                    
                    $zip->close();
                    \Log::info("Arquivo compactado com sucesso usando ZipArchive");
                } else {
                    throw new \Exception("Não foi possível criar o arquivo ZIP com ZipArchive");
                }
            } else {
                // Tentar usar o comando zip do sistema
                \Log::info("ZipArchive não disponível, tentando comando zip do sistema");
                
                // Verificar se o comando zip está disponível
                $checkZip = shell_exec('which zip');
                if (empty($checkZip)) {
                    \Log::warning("Comando zip não encontrado, retornando apenas o arquivo criptografado");
                    // Remover o arquivo SQL original
                    if (file_exists($sqlPath)) {
                        unlink($sqlPath);
                    }
                    return response()->download($encryptedPath)->deleteFileAfterSend(true);
                }
                
                // Criar arquivo README
                $readmeContent = "Este backup foi criptografado para maior segurança.\n";
                $readmeContent .= "Para descriptografar, use a função de restauração do sistema ou entre em contato com o suporte.\n";
                $readmeContent .= "Data de criação: " . now()->format('d/m/Y H:i:s') . "\n";
                $readmeContent .= "Banco de dados: {$database}\n";
                
                $readmePath = storage_path("app/backups/README.txt");
                file_put_contents($readmePath, $readmeContent);
                
                // Usar o comando zip com senha
                $command = sprintf(
                    'cd %s && zip -P %s %s %s %s',
                    escapeshellarg(dirname($encryptedPath)),
                    escapeshellarg($zipPassword),
                    escapeshellarg(basename($zipPath)),
                    escapeshellarg(basename($encryptedPath)),
                    escapeshellarg(basename($readmePath))
                );
                
                \Log::info("Executando comando zip: " . preg_replace('/-P ([^ ]+)/', '-P ******', $command));
                
                exec($command, $output, $resultCode);
                
                // Remover o arquivo README temporário
                if (file_exists($readmePath)) {
                    unlink($readmePath);
                }
                
                if ($resultCode !== 0 || !file_exists($zipPath)) {
                    \Log::error("Falha ao criar arquivo ZIP: " . implode("\n", $output));
                    \Log::warning("Retornando apenas o arquivo criptografado");
                    
                    // Remover o arquivo SQL original
                    if (file_exists($sqlPath)) {
                        unlink($sqlPath);
                    }
                    
                    return response()->download($encryptedPath)->deleteFileAfterSend(true);
                }
                
                \Log::info("Arquivo compactado com sucesso usando comando zip");
            }
            
            // Remover os arquivos temporários após compactação
            if (file_exists($zipPath) && filesize($zipPath) > 0) {
                if (file_exists($sqlPath)) {
                    unlink($sqlPath);
                }
                if (file_exists($encryptedPath)) {
                    unlink($encryptedPath);
                }
                
                \Log::info("Retornando arquivo ZIP com senha");
                return response()->download($zipPath)->deleteFileAfterSend(true);
            } else {
                // Se algo deu errado com a compactação, retornar o arquivo criptografado
                \Log::warning("Problema com a compactação, retornando apenas o arquivo criptografado");
                
                // Remover o arquivo SQL original
                if (file_exists($sqlPath)) {
                    unlink($sqlPath);
                }
                
                return response()->download($encryptedPath)->deleteFileAfterSend(true);
            }
            
        } catch (\Exception $e) {
            \Log::error('Erro no backup: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error', 'Erro ao fazer backup: ' . $e->getMessage());
        }
    }
    
    // Função para configurar a conexão dinâmica para a base de dados da empresa
    public function setEmpresaDatabaseConnection($empresa)
    {
        // Exemplo de como definir a conexão dinâmica
        config([
            'database.connections.empresa' => [
                'driver' => 'mysql',
                'host' => $empresa->db_host,
                'port' => '3306',
                'database' => $empresa->db_name,
                'username' => $empresa->db_user,
                'password' => $empresa->db_password,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]
        ]);

        // Definir a conexão para usar a base da empresa
        DB::setDefaultConnection('empresa');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }

    /**
     * Função para restaurar um backup criptografado
     * Esta função pode ser implementada posteriormente para restaurar os backups
     */
    public function restaurarBackup(Request $request)
    {
        // Implementação futura para restaurar backups criptografados
        return back()->with('info', 'Funcionalidade em desenvolvimento.');
    }
}
