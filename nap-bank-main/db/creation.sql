CREATE TABLE IF NOT EXISTS "usuario" (
	id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
	apelido_usuario VARCHAR(16) UNIQUE NOT NULL,
	email_usuario VARCHAR(48) UNIQUE NOT NULL,
	senha_usuario VARCHAR(255) NOT NULL,
	nome_usuario VARCHAR(128) NOT NULL,
	cpf_usuario VARCHAR(14),
	data_nascimento VARCHAR(11),
	saldo REAL DEFAULT(0.0),
	fatura REAL DEFAULT(0.0)
);
CREATE TABLE IF NOT EXISTS "sessao" (
	id_sessao VARCHAR(22) PRIMARY KEY,
	id_usuario INTEGER REFERENCES usuario(idUsuario)
);
CREATE TABLE IF NOT EXISTS "chave_pix" (
	chave VARCHAR(256) PRIMARY KEY,
	tipo VARCHAR(7),
	id_usuario INTEGER REFERENCES usuario(idUsuario)  
);
CREATE TABLE IF NOT EXISTS "historico_transferencia" (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	id_remetente INTEGER REFERENCES usuario(idUsuario),
	id_destinatario INTEGER REFERENCES usuario(idUsuario),
	banco_destinatario varchar(5),
	agencia_destinatario varchar(6),
	conta_destinatario varchar(7),
	cpf_destinatario varchar(14),
	chave_destinatario varchar(256),
	data_transferencia varchar(10),
	valor REAL,
	mensagem VARCHAR(256)
);
INSERT INTO "usuario" VALUES (
	1,
	"luis10barbo",
	"luis10barbo2020@gmail.com",
	"$2y$10$SK9cF9CQWVIr5tFKdaPAtutaycDxKKqXq2sPkhew9Pvz.g3UWXSia", /* senha: 123 */
	"Luis Eduardo Nunes",
	"111.222.333-44",
	"01/01/1990",
	0,
	0
);

INSERT INTO "usuario" VALUES (
	2,
	"teste",
	"teste@gmail.com",
	"$2y$10$SK9cF9CQWVIr5tFKdaPAtutaycDxKKqXq2sPkhew9Pvz.g3UWXSia", /* senha: 123 */
	"Teste da Silva Junior",
	"113.752.244-50",
	"01/01/1990",
	0,
	0
);
