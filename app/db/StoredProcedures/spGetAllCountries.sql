/******************************************************
-- Doel: Opvragen van alle records uit de tabel country
-- Versie: 01
-- Datum: 26-09-2024
-- Auteur: Arjan de Ruijter
******************************************************/

-- Selecteer de juiste database voor je stored procedure
use `mvcframework-io-sd-2309a-startertmp`;

-- Verwijder de oude stored procedure
DROP PROCEDURE IF EXISTS spGetAllCountries;

-- Verander even tijdelijk de opdrachtprompt naar //
DELIMITER //

CREATE PROCEDURE spGetAllCountries()
BEGIN

    SELECT  COUN.Id,
            COUN.Name,
            COUN.CapitalCity,
            COUN.Continent,
            COUN.Population,
            COUN.Zipcode
    FROM    Country AS COUN
    ORDER BY COUN.Id ASC;

END //
DELIMITER ;

/************* debug code stored procedure **************

CALL spGetAllCountries();

********************************************************/



