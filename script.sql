create database DbGeniusFit;
use DbGeniusFit;

 CREATE TABLE administradores (
    id int auto_increment PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL, 
    telefone VARCHAR(15),
    salario DECIMAL(10, 2),
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_admissao DATE NOT NULL 
);

 CREATE TABLE professores (
    id int auto_increment PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL, 
    especialidade VARCHAR(100), 
    salario DECIMAL(10, 2) not null,
    telefone VARCHAR(15),
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_admissao DATE NOT NULL 
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT primary key, 
    nome VARCHAR(150) NOT NULL, 
    data_nascimento DATE NOT NULL, 
    telefone VARCHAR(15), 
    email VARCHAR(100) UNIQUE NOT NULL, 
    senha varchar(255),
    data_matricula DATE NOT NULL
);

CREATE TABLE horarios_professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    dia_da_semana ENUM('SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO') NOT NULL,
    turno ENUM('MANHÃ', 'TARDE', 'NOITE', 'INTEGRAL') NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES professores (id),
    UNIQUE KEY (professor_id, dia_da_semana, turno)
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    aluno_id INT NOT NULL,
    horario_id INT NOT NULL, 
    data_aula DATE NOT NULL, -- disabilitar no php inserir datas divergentes do horario do professor
    FOREIGN KEY (aluno_id) REFERENCES alunos(id), 
    FOREIGN KEY (horario_id) REFERENCES horarios_professores(id) 
);

CREATE TABLE folha_pagamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    administrador_id INT NOT NULL, 
    professor_id INT NOT NULL, 
    mes tinyint NOT NULL, 
    ano smallint NOT NULL, 
    salario_bruto DECIMAL(10, 2) NOT NULL, -- setado por trigger calcula_folha_pagamento
    descontos DECIMAL(10, 2) DEFAULT 0.00, 
    salario_liquido DECIMAL(10, 2) NOT NULL, -- setado por trigger calcula_folha_pagamento
    data_pagamento DATE NOT NULL,
    data_envio date default(null), -- data em que o registro estara visivel para o professor no front
    FOREIGN KEY (administrador_id) REFERENCES administradores(id), 
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);
 -- SHOW TRIGGERS;
DELIMITER //
CREATE TRIGGER calcula_folha_pagamento
BEFORE INSERT ON folha_pagamento
FOR EACH ROW
BEGIN
    DECLARE salario_professor DECIMAL(10, 2);
    
    SELECT salario INTO salario_professor
    FROM professores
    WHERE id = new.professor_id;
    
    SET NEW.salario_bruto = salario_professor;
    SET NEW.salario_liquido = salario_professor - new.descontos;
END;
// DELIMITER ;

