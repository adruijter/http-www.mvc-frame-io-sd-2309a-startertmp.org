/******************************************************
-- Doel: Updaten van een record in de tabel Country op
         basis van het Id
*******************************************************
-- Versie: 01
-- Datum: 26-09-2024
-- Auteur: Arjan de Ruijter
******************************************************/

-- Selecteer de juiste database voor je stored procedure
use `mvcframework-io-sd-2309a-startertmp`;

-- Verwijder de oude stored procedure
DROP PROCEDURE IF EXISTS spUpdateCountryById;

-- Verander even tijdelijk de opdrachtprompt naar //
DELIMITER //

CREATE PROCEDURE spUpdateCountryById(
    IN Id INT UNSIGNED
)
BEGIN

    SELECT  COUN.Id,
            COUN.Name,
            COUN.CapitalCity,
            COUN.Continent,
            COUN.Population,
            COUN.Zipcode
    FROM    Country AS COUN
    WHERE   COUN.Id = Id;

END //
DELIMITER ;

/************* debug code stored procedure **************

CALL spGetAllCountries();

********************************************************/



