**Front feito por:** [Karlos Eduardo](https://github.com/DevCabuloso)


**Banco de dados:**

    CREATE TABLE tb_paciente (
      id INT NOT NULL AUTO_INCREMENT,
      nome VARCHAR(255) NOT NULL,
      data_nascimento DATE NULL,
      cpf VARCHAR(14) UNIQUE NULL,
      rg VARCHAR(12) BINARY NULL,
      PRIMARY KEY(id)
    );
    
    CREATE TABLE tb_responsavel (
      id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
      tb_paciente_id INT NOT NULL,
      nome VARCHAR(255) NULL,
      data_nascimento DATE NULL,
      cpf VARCHAR(14) UNIQUE NULL,
      rg VARCHAR(15) NULL,
      PRIMARY KEY(id),
      INDEX tb_responsavel_FKIndex1(tb_paciente_id),
      FOREIGN KEY(tb_paciente_id)
        REFERENCES tb_paciente(id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION
    );
    
    CREATE TABLE tb_atendimento (
      id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
      tb_paciente_id INT NOT NULL,
      data_chegada DATE NOT NULL,
      hora_chegada TIME NULL,
      estado VARCHAR(100) NULL,
      gravidade CHAR NULL,
      PRIMARY KEY(id),
      INDEX tb_atendimento_FKIndex1(tb_paciente_id),
      FOREIGN KEY(tb_paciente_id)
        REFERENCES tb_paciente(id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION
    );

