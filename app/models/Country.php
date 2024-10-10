<?php

class Country
{
    private $db;

    public function __construct()
    {
        /**
         * Maak een nieuw database object die verbinding maakt met de 
         * MySQL server
         */
        $this->db = new Database();
    }

    /**
     * Haal alle records op uit de Country-tabel
     */
    public function getCountries()
    {
        try {
            /**
             * Maak een sql-query die de gewenste informatie opvraagt uit de database
             * We gebruiken de stored procedure spGetCountries()
             */

            $sql = 'CALL spGetAllCountries()';

            /**
             * Prepare de query voor het PDO object
             */
            $this->db->query($sql);

            /**
             * Geef de opgehaalde informatie terug aan de controller
             */
            return $this->db->resultSet();

        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function createCountry($postArrayData) 
    {
        try {
            /**
             * Maak een sql-query die de ingevulde gegevens van het formulier
             * wegschrijft naar de database
             */
            
            $sql = 'CALL spCreateCountry(
                :name, 
                :capitalcity, 
                :continent, 
                :population, 
                :zipcode
            )';
    
             /**
             * Maak de query $sql gereed voor het PDO database-object
             */
            $this->db->query($sql);
    
            /**
             * We koppelen de waardes uit het formulier aan de parameters in de query
             */
            $this->db->bind(':name', $postArrayData['country'], PDO::PARAM_STR);
            $this->db->bind(':capitalcity', $postArrayData['capitalCity'], PDO::PARAM_STR);
            $this->db->bind(':continent', $postArrayData['continent'], PDO::PARAM_STR);
            $this->db->bind(':population', $postArrayData['population'], PDO::PARAM_INT);
            $this->db->bind(':zipcode', $postArrayData['zipcode'], PDO::PARAM_STR);
    
            /**
             * Voer de query uit zodat de gegevens worden weggeschreven naar de database
             */
            return $this->db->execute();
        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getCountry($countryId)
    {
        try {

            $sql = 'CALL spSelectCountryById(:id)';
    
            $this->db->query($sql);
    
            $this->db->bind(':id', $countryId, PDO::PARAM_INT);
    
            return $this->db->single();

        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }

    }

    public function updateCountry($postArrayData)
    {
        try {
            $sql = 'CALL spUpdateCountryById(
                        :id, 
                        :name, 
                        :capitalcity, 
                        :continent, 
                        :population, 
                        :zipcode
                    )';        
    
            $this->db->query($sql);
    
            $this->db->bind(':name', $postArrayData['country'], PDO::PARAM_STR);
            $this->db->bind(':capitalcity', $postArrayData['capitalCity'], PDO::PARAM_STR);
            $this->db->bind(':continent', $postArrayData['continent'], PDO::PARAM_STR);
            $this->db->bind(':population', $postArrayData['population'], PDO::PARAM_INT);
            $this->db->bind(':zipcode', $postArrayData['zipcode'], PDO::PARAM_STR);
            $this->db->bind(':id', $postArrayData['Id'], PDO::PARAM_INT);
    
            return $this->db->execute();        
        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }

    }

    public function deleteCountry($countryId)
    {
        try {
            /**
             * Maak een sql-query die een record uit de database verwijdert
             */
    
            $sql = 'CALL spDeleteCountryById(:id)';
    
            /**
             * Prepare de query voor het PDO object
             */
            $this->db->query($sql);
    
            /**
             * Koppel de parameter aan de query
             */
            $this->db->bind(':id', $countryId, PDO::PARAM_INT);
    
            /**
             * Voer de query uit
             */ 
            return $this->db->execute();
        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

}