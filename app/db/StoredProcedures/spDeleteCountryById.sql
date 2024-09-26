/******************************************************
-- Doel: Deleten van een record in de tabel Country op
         basis van het Id
*******************************************************
-- Versie: 01
-- Datum: 26-09-2024
-- Auteur: Arjan de Ruijter
******************************************************/

-- Selecteer de juiste database voor je stored procedure
use `mvcframework-io-sd-2309a-startertmp`;

-- Verwijder de oude stored procedure
DROP PROCEDURE IF EXISTS spDeleteCountryById;

-- Verander even tijdelijk de opdrachtprompt naar //
DELIMITER //

CREATE PROCEDURE spDeleteCountryById(
    IN Id INT UNSIGNED
)
BEGIN
    DELETE  
    FROM    Country AS COUN
    WHERE   COUN.Id = Id;
END //
DELIMITER ;

/************* debug code stored procedure **************

CALL spDeleteCountryById(2);

********************************************************/



