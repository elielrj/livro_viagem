
use livro_viagem;

SELECT v.enderecoId, v.territorio, e.id, b.nome, e.nome, c.nome, c.id, COUNT(*) 
FROM viagem as v

INNER JOIN endereco as e
ON e.id = v.enderecoId and v.territorio = "NACIONAL"

JOIN bairro as b
ON e.bairroId = b.id

JOIN cidade as c
ON b.cidadeId = c.id

GROUP BY c.nome
HAVING count(*) >= 0
;

SELECT v.territorio, c.nome, c.estadoId, c.id, COUNT(*) 
FROM viagem as v

INNER JOIN endereco as e
ON e.id = v.enderecoId and v.territorio = 'NACIONAL'

JOIN cidade as c
ON e.cidadeId = c.id

GROUP BY c.nome
HAVING count(*) >= 0;
                        
                        
SELECT v.territorio, c.nome, c.estadoId, c.id, COUNT(*) 
FROM viagem as v

INNER JOIN endereco as e
ON e.id = v.enderecoId and v.territorio = 'Nacional'

JOIN bairro as b
ON e.bairroId = b.id

JOIN cidade as c
ON b.cidadeId = c.id

GROUP BY c.nome
HAVING count(*) >= 0;
