# Scripts de Backup e Restauração

Este diretório contém scripts para gerenciamento de backups do banco de dados.

## Restaurar Backup

O script `restaurar_backup.php` permite restaurar um backup criptografado diretamente pelo terminal, sem precisar usar a interface web.

### Uso

```bash
php restaurar_backup.php [caminho_do_arquivo] [senha] [host] [usuario] [senha_db] [banco]
```

### Parâmetros

- `caminho_do_arquivo`: Caminho completo para o arquivo de backup (.zip ou .enc)
- `senha`: Senha usada para criptografar o backup (mesma senha da empresa)
- `host`: Endereço do servidor MySQL (ex: localhost)
- `usuario`: Nome de usuário do MySQL
- `senha_db`: Senha do usuário MySQL
- `banco`: Nome do banco de dados a ser restaurado

### Exemplo

```bash
php restaurar_backup.php /home/user/backups/backup_meudb_20250510.zip minhasenha123 localhost root senha123 meu_banco
```

### Observações

- O script suporta tanto arquivos ZIP quanto arquivos .enc diretamente
- A restauração substituirá todos os dados existentes no banco de dados
- Certifique-se de ter permissões adequadas para executar o script e acessar o banco de dados
- Recomenda-se fazer um backup do banco atual antes de restaurar um backup antigo
