-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2024 às 00:26
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Verificar se o banco de dados existe e, se existir, excluí-lo
DROP DATABASE IF EXISTS 'smarttasksdb';

-- Criar um novo banco de dados
CREATE DATABASE 'smarttasksdb';
USE 'smarttasksdb';

--
-- Banco de dados: `smarttasksdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `empresa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `empresa`) VALUES
(2, 'Byte Tech'),
(5, 'Hardware redes'),
(6, 'tech companhia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(6) NOT NULL,
  `codigo` int(4) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `tipo_projeto` varchar(20) NOT NULL,
  `fk_gestor` int(11) NOT NULL,
  `descricao_projeto` varchar(255) NOT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `datain` date NOT NULL,
  `dataout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `codigo`, `titulo`, `tipo_projeto`, `fk_gestor`, `descricao_projeto`, `contrato`, `anexo`, `datain`, `dataout`) VALUES
(63, 5070, 'Projeto Integração de novas APIs', 'Tecnologia da Inform', 62, 'Projeto atualizado', 'contrato_250124.docx', 'cronograma.xlsx', '2024-03-19', '2024-03-20'),
(64, 7310, 'Projeto limpeza de dados', 'Tecnologia da Inform', 62, 'expurgo de dados com mais de 5 anos', '', '', '2024-03-27', '2024-03-29'),
(66, 2062, 'Plataforma de automações', 'Tecnologia da Inform', 62, 'Criação uma plataforma digital para automatizar processos complexos em diversas áreas, desde operações empresariais até tarefas do dia a dia', '', '', '2024-04-05', '2024-05-10'),
(67, 5627, 'Sistema de Gestão de Saúde', 'Tecnologia da Inform', 64, 'Implementação de um sistema completo para gestão de saúde em instituições médicas, incluindo agendamento de consultas, prontuários eletrônicos, acompanhamento de pacientes, integração com laboratórios e geração de relatórios estatísticos.', 'contrato_250124.docx', 'cronograma.xlsx', '2024-05-17', '2024-06-17'),
(71, 8818, 'GreenEarth Dados', 'Pesquisa e Desenvolv', 62, 'Soluções para crédito de carbono', '', '', '2024-05-26', '2024-05-28'),
(72, 1931, 'Prospera', 'Tecnologia da Inform', 64, 'Controle financeiro para grupo 1 selecionado', '', '', '2024-05-26', '2024-05-29'),
(73, 8823, 'Dados Analytics', 'Tecnologia da Inform', 62, 'Análise de dados', '', '', '2024-05-26', '2024-05-31'),
(78, 2206, 'Invistorico', 'Tecnologia da Inform', 57, 'App para trader', 'contrato_250124.docx', 'cronograma.xlsx', '2024-05-29', '2024-05-31'),
(79, 8178, 'Soluções para agro', 'Pesquisa e Desenvolv', 62, 'Pesquisa e desenvolvimento de soluções para clientes do agro', '', '', '2024-05-29', '2024-05-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_tarefas2`
--

CREATE TABLE `status_tarefas2` (
  `id_statustarefa` int(11) NOT NULL,
  `status_tarefa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `status_tarefas2`
--

INSERT INTO `status_tarefas2` (`id_statustarefa`, `status_tarefa`) VALUES
(1, 'Não iniciado'),
(2, 'Em progresso'),
(3, 'Aguardando'),
(4, 'Concluído');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(6) NOT NULL,
  `id_projt` int(6) NOT NULL,
  `fk_statustarefa` int(11) NOT NULL,
  `tarefa` varchar(50) NOT NULL,
  `prioridade` varchar(20) NOT NULL,
  `codtarefa` int(4) NOT NULL,
  `descricao_tarefa` varchar(255) NOT NULL,
  `datain` date NOT NULL,
  `dataout` date NOT NULL,
  `responsavel` varchar(50) NOT NULL,
  `responsavel2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefa`, `id_projt`, `fk_statustarefa`, `tarefa`, `prioridade`, `codtarefa`, `descricao_tarefa`, `datain`, `dataout`, `responsavel`, `responsavel2`) VALUES
(147, 63, 4, 'Desenvolvimento de Integração com API Externa', 'Alta', 7949, 'Implementar a integração de uma nova API externa para aprimorar a funcionalidade do sistema existente, garantindo compatibilidade e segurança dos dados.', '2024-03-12', '2024-03-19', 'ursula@email.com', 'jose@email.com'),
(148, 63, 4, 'Teste e Validação das Integrações de APIs', 'Alta', 7255, 'Executar testes abrangentes para validar a integração das novas APIs, garantindo que todas as funcionalidades estejam operando conforme esperado. Isso inclui testes de carga, testes de funcionalidade e verificação de segurança para assegurar a integridade', '2024-03-19', '2024-03-29', 'joanna@email.com', 'jose@email.com'),
(152, 64, 3, 'Implementação de Sistema de Gestão de Saúde', 'Alta', 4937, 'Desenvolver e implementar um sistema abrangente de gestão de saúde que facilite o acompanhamento de pacientes, agendamentos e registros médicos.', '2024-03-30', '2024-03-31', 'joao@email.com', 'maria@email.com'),
(153, 66, 1, 'Criação uma plataforma digital', 'Alta', 2366, 'criação, gerenciamento e monitoração dos fluxos de trabalho automatizados de forma intuitiva e personalizada', '2024-04-05', '2024-05-10', 'joanna@email.com', 'alberto@email.com'),
(154, 66, 4, 'Desenvolvimento de Plataforma de Automação de Proc', 'Média', 3169, 'Criar uma plataforma que automatize processos repetitivos, visando aumentar a eficiência operacional e reduzir erros manuais.', '2024-04-01', '2024-04-05', 'renato@email.com', 'luiz@email.com'),
(155, 66, 1, 'Desenvolvimento de Fluxos de Trabalho Automatizado', 'Alta', 7219, 'Criar fluxos de trabalho automatizados que integram diferentes sistemas e ferramentas, visando reduzir o tempo de execução de tarefas repetitivas e melhorar a produtividade.', '2024-04-01', '2024-04-05', 'joanna@email.com', 'tonico@email.com'),
(156, 66, 1, 'Implementação de Robôs de Processos Automatizados ', 'Baixa', 7220, 'Desenvolver e implementar robôs de automação de processos (RPA) para executar tarefas administrativas, como entrada de dados e geração de relatórios, de maneira eficiente e precisa.', '2024-04-01', '2024-04-05', 'joao@email.com', 'antonio@email.com'),
(157, 66, 4, 'Configuração de Alertas Automatizados', 'Baixa', 7221, 'Configurar alertas automatizados que notificam a equipe sobre eventos críticos ou anomalias nos sistemas, permitindo uma resposta rápida e eficiente a possíveis problemas.', '2024-04-01', '2024-04-05', 'joao@email.com', 'antonio@email.com'),
(158, 66, 1, 'Automação de Processos de Atendimento ao Cliente', 'Alta', 9142, 'Desenvolver scripts e fluxos automatizados para melhorar os processos de atendimento ao cliente, incluindo respostas automáticas a perguntas frequentes e encaminhamento de solicitações complexas para agentes humanos.', '2024-04-07', '2024-04-16', 'glauber@email.com', 'glaubinho@email.com'),
(159, 66, 1, 'Criação de Scripts de Automação para Testes de Sof', 'Alta', 8514, 'Escrever e implementar scripts de automação para testes de software, garantindo que todas as funcionalidades do sistema sejam testadas de forma eficiente e regular.', '2024-04-07', '2024-04-27', 'joanna@email.com', 'arthur@email.com'),
(160, 66, 3, 'Automação de Processos de Integração Contínua (CI/', 'Alta', 9529, 'Implementar pipelines de integração e entrega contínua (CI/CD) para automatizar o processo de construção, teste e implantação de software, melhorando a qualidade e a velocidade das releases.', '2024-04-07', '2024-04-16', 'joanna@email.com', 'arthur@email.com'),
(161, 66, 1, 'Automação de Relatórios Financeiros', 'Alta', 2964, 'Desenvolver sistemas que automatizem a geração e distribuição de relatórios financeiros, garantindo precisão e pontualidade na entrega de informações críticas para a tomada de decisões.', '2024-04-07', '2024-04-16', 'joanna@email.com', 'ursula@email.com'),
(162, 66, 2, 'Criação uma plataforma digital ', 'Alta', 2012, 'Criação uma plataforma digital para automatizar processos complexos em diversas áreas, desde operações empresariais até tarefas do dia a dia', '2024-04-05', '2024-05-10', 'hugo@email.com', 'stella@email.com'),
(163, 66, 1, 'Desenvolvimento de Scripts de Extração de Dados', 'Alta', 2711, 'Criar scripts que automatizem a extração de dados financeiros de diferentes fontes, como bancos de dados, sistemas de ERP e planilhas, garantindo a coleta de informações precisas e atualizadas para os relatórios.', '2024-04-07', '2024-04-16', 'ana@email.com', 'ursula@email.com'),
(164, 66, 1, 'Criação de Templates de Relatórios Personalizados', 'Alta', 5666, 'Desenvolver templates de relatórios financeiros personalizáveis que possam ser automaticamente preenchidos com os dados extraídos, permitindo a geração rápida e consistente de relatórios financeiros mensais, trimestrais e anuais.', '2024-04-07', '2024-04-17', 'fabio@email.com', 'renato@email.com'),
(165, 66, 1, 'Implementação de Sistema de Distribuição Automatiz', 'Alta', 9763, 'Configurar um sistema que automatize a distribuição dos relatórios financeiros gerados, enviando-os por e-mail para os stakeholders relevantes ou disponibilizando-os em uma plataforma centralizada de fácil acesso, garantindo a entrega pontual e segura das', '2024-04-10', '2024-04-10', 'stella@email.com', 'a@email.com'),
(166, 67, 1, 'Elaborar cronograma de implementação do sistema.', 'Alta', 1805, 'Criar um plano detalhado com as etapas e prazos para implementação do sistema de gestão de saúde.', '2024-05-20', '2024-05-20', 'andre_araujo@email.com', 'marina_atila@email.com'),
(167, 67, 1, 'Definir fluxo de trabalho para atendimento ao clie', 'Média', 8584, 'Estabelecer processos e protocolos para garantir um atendimento eficiente e de qualidade aos clientes.', '2024-05-21', '2024-05-22', 'stella@email.com', 'eduardo@email.com'),
(168, 67, 1, 'Criar manual de procedimentos para utilização do s', 'Média', 9382, 'Elaborar um guia completo para usuários sobre como utilizar todas as funcionalidades do sistema', '2024-05-20', '2024-05-24', 'marina_atila@email.com', 'eduardo@email.com'),
(169, 67, 1, 'Contratar equipe de desenvolvimento e suporte', 'Alta', 9408, 'Recrutar profissionais qualificados para desenvolver e dar suporte ao sistema.', '2024-05-27', '2024-05-31', 'marina_atila@email.com', 'eduardo@email.com'),
(171, 73, 1, 'Limpeza e Normalização de Dados Empresariais', 'Baixa', 9082, 'Executar um projeto de limpeza e normalização de dados empresariais para assegurar a qualidade e integridade dos dados utilizados nas operações diárias.', '2024-05-26', '2024-05-27', 'jose@gmail.com', 'joanna@email.com'),
(172, 73, 1, 'Criação de Dashboards de Dados Analytics', 'Baixa', 6410, 'Desenvolver dashboards interativos que apresentem análises de dados complexos de maneira visual e intuitiva para facilitar a tomada de decisões estratégicas.', '2024-05-26', '2024-05-28', 'jose@gmail.com', 'joanna@email.com'),
(173, 73, 1, 'Análise e Otimização de Dados', 'Alta', 9167, 'Realizar uma análise detalhada dos dados existentes e otimizar a estrutura de armazenamento para melhorar a eficiência e a performance do banco de dados.', '2024-05-26', '2024-05-28', 'jose@gmail.com', 'joanna@email.com'),
(174, 73, 1, 'Desenvolvimento de Modelos Preditivos para Análise', 'Baixa', 3585, ' Criar e implementar modelos preditivos utilizando técnicas de machine learning para analisar tendências e padrões em grandes volumes de dados, visando aprimorar a tomada de decisões estratégicas.', '2024-05-26', '2024-05-27', 'hduahidhsaudia', 'hdiauhdiusahduia'),
(175, 73, 1, 'Implementação de Pipeline de Dados Automatizado', 'Baixa', 3337, 'Desenvolver e configurar um pipeline de dados automatizado que integre diferentes fontes de dados, garantindo a coleta, transformação e carregamento contínuo de dados para um data warehouse centralizado.', '2024-05-26', '2024-05-28', 'dhasudhisahdusa', 'dsahidhasoudhshau'),
(176, 73, 1, 'hufdshfishdiufshdiufs', 'Baixa', 4785, 'udhasidhasihudisuahudasdas', '2024-05-26', '2024-05-28', 'dhaudhisahduiahduas', 'dhusiadhiauhdiuahdiuashda'),
(177, 73, 1, 'fuhdsuhfisudhfuisdhfsd', 'Baixa', 8437, 'udhaisudhsahdisahudias', '2024-05-26', '2024-05-28', 'haudhsadusaih', 'dhasihduisahdhsiah'),
(178, 71, 3, 'Coleta de dados', 'Média', 9279, 'Web Scraping', '2024-05-26', '2024-05-28', 'joanna@email.com', 'bruna2@email.com'),
(180, 72, 1, 'tarefa atualizada', 'Alta', 6256, 'atualizar tarefa', '2024-05-27', '2024-05-28', 'bruna2@email.com', 'bruna9@email.com'),
(181, 64, 1, 'Consultar quais dados deverão ser removidos', 'Alta', 4233, 'Ver com time responsável quais dados do projeto deverão ser removidos e qual o prazo', '2024-05-29', '2024-05-29', 'bruna2@email.com', 'jose@email.com'),
(182, 63, 1, 'Design de API', 'Média', 2122, 'é o processo de criação de uma interface API bem definida que permite que dois componentes de software interajam entre si', '2024-05-29', '2024-05-29', 'bruna2@email.com', 'jose@gmail.com'),
(183, 67, 1, 'Definir cronograma', 'Alta', 9636, 'Definição de cronograma em parceria com outros times', '2024-05-29', '2024-05-29', 'bruna2@email.com', 'jose@gmail.com'),
(184, 72, 1, 'dihaudhsaiudhuais', 'Média', 8400, 'dhsaudsuiahduiashdiuas', '2024-05-29', '2024-05-29', 'dhasudhasiudhuiashda', 'dsahduashdiuashh'),
(185, 78, 1, 'Reunião com cliente rico++', 'Alta', 8679, 'Marcar reunião com o cliente para semana que vem', '2024-05-29', '2024-05-29', 'bruna2@email.com', 'jose@gmail.com'),
(186, 79, 1, 'Reunião de planejamento', 'Alta', 8023, 'Organizar reunião de planejamento', '2024-05-29', '2024-05-30', 'bruna2@email.com', 'jose@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(200) NOT NULL,
  `email_usuario` varchar(200) NOT NULL,
  `senha_usuario` varchar(200) DEFAULT NULL,
  `nivel_usuario` int(2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `interrupted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `nivel_usuario`, `status`, `created`, `interrupted`) VALUES
(20, 'Julio Ribeiro Santos', 'julio.r.santos@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'Ativo', '2024-01-01 00:00:00', '0000-00-00 00:00:00'),
(22, 'Daniel Barros Souza', 'daniel_barross@gmail.com ', '81bce1f3bf343c464685d875c626820cdb58e309', 3, 'Ativo', '2024-03-18 00:00:00', '0000-00-00 00:00:00'),
(30, 'Renato Silva', 'contato@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 'Inativo', '2024-03-10 00:00:00', '2024-03-11 22:25:57'),
(57, 'Bruna do Nascimento', 'bruna@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'Ativo', '2024-03-14 00:00:00', '0000-00-00 00:00:00'),
(60, 'Antonia Aleluia', 'antonia@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 'Ativo', '2024-03-11 00:00:00', '0000-00-00 00:00:00'),
(61, 'Luana Evellyn', 'luana_ev@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 'Ativo', '2024-11-11 00:00:00', '2024-03-21 21:13:27'),
(62, 'Samantha Morimoto', 'sam.mori@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 'Ativo', '2024-03-11 00:00:00', '0000-00-00 00:00:00'),
(64, 'Antonio Carlos', 'ac@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 'Ativo', '2024-05-15 20:24:47', '0000-00-00 00:00:00'),
(65, 'Bruna do Nascimento', 'bruna2@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 'Ativo', '2024-05-21 21:46:47', '2024-05-30 18:04:42'),
(78, 'Ana Almeida Melo', 'ana_almeida_melo@yahoo.com ', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 'Inativo', '2024-05-29 13:36:16', '0000-00-00 00:00:00'),
(79, 'Mateus Martins Cardoso', 'mateus.cardoso@outlook.com ', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 'Inativo', '2024-05-29 13:36:40', '0000-00-00 00:00:00'),
(81, 'Luiza Cavalcanti Barbosa', 'luiza_cavalcanti_barbosa@gmail.com ', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 'Inativo', '2024-05-29 13:47:53', '0000-00-00 00:00:00'),
(82, 'Gabriela Santos Lima', 'gabrielasantoslima@gmail.com ', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 'Ativo', '2024-05-30 16:03:54', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`),
  ADD KEY `fk_gestor` (`fk_gestor`);

--
-- Índices para tabela `status_tarefas2`
--
ALTER TABLE `status_tarefas2`
  ADD PRIMARY KEY (`id_statustarefa`);

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`),
  ADD KEY `fk_projeto` (`id_projt`),
  ADD KEY `fk_id_statustarefa` (`fk_statustarefa`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `status_tarefas2`
--
ALTER TABLE `status_tarefas2`
  MODIFY `id_statustarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `fk_gestor` FOREIGN KEY (`fk_gestor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_id_statustarefa` FOREIGN KEY (`fk_statustarefa`) REFERENCES `status_tarefas2` (`id_statustarefa`),
  ADD CONSTRAINT `fk_projeto` FOREIGN KEY (`id_projt`) REFERENCES `projetos` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
