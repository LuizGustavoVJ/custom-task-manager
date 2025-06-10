# Custom Task Manager

Sistema de gerenciamento de tarefas customizado baseado no Jira, desenvolvido pela equipe "Desenvolvimento Pessoal".

## Sobre o Projeto

Este é um sistema web de gerenciamento de tarefas e projetos, inspirado no Jira, desenvolvido com:

- **Backend:** Laravel 10 + PHP 8
- **Frontend:** Vue.js 3
- **Banco de Dados:** SQLite (desenvolvimento) / MySQL (produção)
- **Autenticação:** Laravel Sanctum
- **Testes:** PHPUnit + Pest
- **CI/CD:** GitHub Actions

## Funcionalidades Principais

- ✅ Gerenciamento de Projetos
- ✅ Criação e acompanhamento de tarefas
- ✅ Sistema de usuários e permissões
- ✅ Dashboard com métricas e relatórios
- ✅ Sistema de comentários
- ✅ Histórico de atividades
- ✅ API RESTful completa
- ✅ Interface responsiva

## Equipe de Desenvolvimento

- **ProductManagerAI:** Product Management e Product Ownership
- **Desenvolvedor BackEnd:** Especialista em PHP/Laravel
- **Desenvolvedor FrontEnd:** Especialista em Vue.js
- **Arquiteto:** Arquitetura de Software e Design de Sistemas
- **Agente QA:** Garantia de Qualidade e Testes
- **Agente CI/CD:** Integração e Entrega Contínua

## Instalação

```bash
# Clone o repositório
git clone https://github.com/LuizGustavoVJ/custom-task-manager.git

# Entre no diretório
cd custom-task-manager

# Instale as dependências do PHP
composer install

# Instale as dependências do Node.js
npm install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Execute as migrações
php artisan migrate

# Compile os assets
npm run build

# Inicie o servidor
php artisan serve
```

## Desenvolvimento

### Padrões de Branch

- `feature/nome-da-funcionalidade` - Novas funcionalidades
- `bugfix/nome-do-bug` - Correções de bugs
- `hotfix/nome-da-correcao` - Correções urgentes
- `release/versao` - Preparação de releases

### Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes específicos
php artisan test --filter=NomeDoTeste
```

## Licença

Este projeto é licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

