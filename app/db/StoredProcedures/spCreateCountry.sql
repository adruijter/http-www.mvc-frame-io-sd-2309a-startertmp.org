/******************************************************
-- Doel: Inserten van een record in de tabel Country op
*******************************************************
-- Versie:  01
-- Datum:   26-09-2024
-- Auteur:  Arjan de Ruijter
******************************************************/

-- Selecteer de juiste database voor je stored procedure
use `mvcframework-io-sd-2309a-startertmp`;

-- Verwijder de oude stored procedure
DROP PROCEDURE IF EXISTS spCreateCountry;

-- Verander even tijdelijk de opdrachtprompt naar //
DELIMITER //

CREATE PROCEDURE spCreateCountry(
    IN Name         VARCHAR(250),
    IN CapitalCity  VARCHAR(250),
    IN Continent    VARCHAR(250),
    IN Population   INT UNSIGNED,
    IN Zipcode      VARCHAR(6)
)
BEGIN

    INSERT INTO Country (
        Name,
        CapitalCity,
        Continent,
        Population,
        Zipcode
    ) VALUES (
        Name,
        CapitalCity,
        Continent,
        Population,
        Zipcode
    );

END //
DELIMITER ;

/************* debug code stored procedure **************

CALL spCreateCountry('Nederland', 'Amsterdam', 'Europa', 18000000, '2309CB');

********************************************************/



