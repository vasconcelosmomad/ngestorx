#!/bin/bash

# Configurações do projeto
PROJECT_NAME="ngestorx"
GITHUB_USER="vasconcelosmomad"
REPO_URL="https://github.com/${GITHUB_USER}/${PROJECT_NAME}.git"

# Função para exibir mensagens coloridas
echo_color() {
    local color=$1
    local message=$2
    case $color in
        "green") echo -e "\033[32m$message\033[0m" ;;
        "red") echo -e "\033[31m$message\033[0m" ;;
        "yellow") echo -e "\033[33m$message\033[0m" ;;
        *) echo "$message" ;;
    esac
}

# Função para verificar se o comando foi executado com sucesso
check_command() {
    if [ $? -ne 0 ]; then
        echo_color "red" "Erro ao executar o comando anterior"
        exit 1
    fi
}

# 1. Verificar se estamos no diretório correto
echo_color "green" "[1/7] Verificando diretório do projeto..."
if [ ! -d "/home/vasconcelos/my-projects/${PROJECT_NAME}" ]; then
    echo_color "red" "Diretório do projeto não encontrado"
    exit 1
fi
cd "/home/vasconcelos/my-projects/${PROJECT_NAME}"

# 2. Configurar usuário do Git
echo_color "green" "[2/7] Configurando usuário do Git..."
read -p "Digite seu nome: " GIT_NAME
git config --global user.name "$GIT_NAME"
read -p "Digite seu email: " GIT_EMAIL
git config --global user.email "$GIT_EMAIL"

# 3. Inicializar Git
echo_color "green" "[3/7] Inicializando Git..."
rm -rf .git
git init
check_command

# 4. Configurar remote
echo_color "green" "[4/7] Configurando remote do GitHub..."
git remote add origin $REPO_URL
check_command

# 5. Adicionar e commitar arquivos
echo_color "green" "[5/7] Commitando arquivos..."
git add .
git commit -m "Primeiro commit do projeto ${PROJECT_NAME}"
check_command

# 6. Configurar branch principal
echo_color "green" "[6/7] Configurando branch principal..."
git branch -M main
check_command

# 7. Fazer push
echo_color "green" "[7/7] Fazendo push para o GitHub..."
echo_color "yellow" "Por favor, cole seu token do GitHub quando solicitado"
git push -u origin main

# Mensagem final
echo_color "green" "\nConfiguração concluída com sucesso!"
echo_color "green" "Seu projeto está disponível em: $REPO_URL"
echo_color "yellow" "\nAtenção:"
echo_color "yellow" "- Se você não puder fazer login no GitHub, crie um token em:"
echo_color "yellow" "  https://github.com/settings/tokens"
echo_color "yellow" "- Marque a permissão 'repo' ao gerar o token"
