ALTER TABLE `tb_cdm_proprietario` CHANGE `foto` `foto` LONGBLOB NULL DEFAULT NULL;
ALTER TABLE `tb_cdm_morador` CHANGE `foto` `foto` LONGBLOB NULL DEFAULT NULL;
ALTER TABLE `tb_cdm_visitante` CHANGE `foto` `foto` LONGBLOB NULL DEFAULT NULL;



INSERT INTO `tb_cdm_parentesco` (`id`, `descricao`) VALUES
(1, 'Avó'),
(2, 'Avós'),
(3, 'Avô'),
(4, 'Bisavó'),
(5, 'Bisavô'),
(6, 'Cunhada'),
(7, 'Cunhado'),
(8, 'Esposa'),
(9, 'Esposo'),
(10, 'Filha'),
(11, 'Filho'),
(12, 'Prima'),
(13, 'Irmã'),
(14, 'Irmão'),
(15, 'Madrasta'),
(16, 'Madrinha'),
(17, 'Meia Irmã.'),
(18, 'Meio Irmão'),
(19, 'Mãe'),
(20, 'Na Lei'),
(21, 'Neta'),
(22, 'Neto'),
(23, 'Netos'),
(24, 'Padrasto'),
(25, 'Padrinho'),
(26, 'Pai'),
(27, 'Outro'),
(28, 'Primo'),
(29, 'Sobrinha'),
(30, 'Sobrinho'),
(31, 'Sogra'),
(32, 'Sogro'),
(33, 'Tataravó'),
(34, 'Tataravô'),
(35, 'Tia'),
(36, 'Tio'),
(37, 'Amigo'),
(38, 'Amiga');

