#!/bin/bash

# Configurações
WEBHOOK_PORT=9000
WEBHOOK_SECRET="sua_chave_secreta"
DEPLOY_SCRIPT="/caminho/para/deploy.sh"

# Instala dependências
apt-get update
apt-get install -y nodejs npm
npm install -g pm2

# Cria o servidor webhook
cat > /tmp/webhook.js << 'EOL'
const http = require('http');
const crypto = require('crypto');
const { exec } = require('child_process');

const port = process.env.PORT;
const secret = process.env.SECRET;
const deployScript = process.env.DEPLOY_SCRIPT;

const server = http.createServer((req, res) => {
    if (req.method === 'POST' && req.url === '/webhook') {
        let body = '';
        
        req.on('data', chunk => {
            body += chunk.toString();
        });
        
        req.on('end', () => {
            // Verifica a assinatura (se estiver usando GitHub)
            const signature = req.headers['x-hub-signature'];
            if (secret && signature) {
                const hmac = crypto.createHmac('sha1', secret);
                const digest = 'sha1=' + hmac.update(body).digest('hex');
                if (signature !== digest) {
                    res.writeHead(401, { 'Content-Type': 'text/plain' });
                    return res.end('Assinatura inválida');
                }
            }
            
            // Executa o script de deploy
            console.log('Webhook recebido, iniciando deploy...');
            exec(`bash ${deployScript}`, (error, stdout, stderr) => {
                if (error) {
                    console.error(`Erro no deploy: ${error}`);
                    return;
                }
                console.log(`Deploy concluído:\n${stdout}`);
                if (stderr) console.error(`Erros: ${stderr}`);
            });
            
            res.writeHead(200, { 'Content-Type': 'text/plain' });
            res.end('Webhook recebido com sucesso');
        });
    } else {
        res.writeHead(404, { 'Content-Type': 'text/plain' });
        res.end('404 Not Found');
    }
});

server.listen(port, () => {
    console.log(`Servidor webhook rodando na porta ${port}`);
});
EOL

# Inicia o servidor webhook com PM2
PORT=$WEBHOOK_PORT SECRET=$WEBHOOK_SECRET DEPLOY_SCRIPT=$DEPLOY_SCRIPT pm2 start /tmp/webhook.js --name "git-webhook"
pm2 save
pm2 startup

echo "Webhook configurado na porta $WEBHOOK_PORT"
echo "Configure seu repositório Git para enviar webhooks para: http://seu-servidor:$WEBHOOK_PORT/webhook" 